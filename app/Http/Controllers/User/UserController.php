<?php

namespace App\Http\Controllers\User;

use App\Enums\StatusEnum;
use App\Events\UpdateChange;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\Candidate;
use App\Models\ListVote;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
class UserController extends Controller
{
//    public function update(Request $request){
//        $validator = \Validator::make($request->all(), [
//            'name'=>'required|string',
//            'gender'=>'required|not_in:NULL',
//            'phone'=>'required|phone:RU',
//            'address'=>'required|string',
//        ]);
//
//        if(!$validator->passes()){
//            return response()->json(['code'=> 0, 'error'=> $validator->errors()->toArray()]);
//        } else {
//            $user = auth()->user();
//            $user->name = $request->name;
//            $user->gender = $request->gender;
//            $user->phone = $request->phone;
//            $user->address = $request->address;
//            $user->save();
//
//            return response()->json(['code'=>1, 'name' => $request->name]);
//        }
//    }

    public function check(Request $request){
        $this->validate($request,[
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5|max:30',
        ]);

        $creds = $request->only('email', 'password');
        if(Auth::guard('web')->attempt($creds)){
            return redirect()->route('main.index');
        } else {
            return back()->with('fail', __('notifications.ERROR.Check your email and password'));
        }
    }

    public function updateAvatar(Request $request){
        $user = auth()->user();

        $folderPath = 'data/images/upload/users/';

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';

        $imageFullPath = $folderPath.$imageName;

        file_put_contents($imageFullPath, $image_base64);

        $user->image = $imageName;
        $save = $user->save();

        $url=asset("data/images/upload/users/$imageName");

        if($save){
            return response()->json(['code' => 1, 'url' => $url]);
        } else {
            return response()->json(['code' => 0]);
        }
    }

    public function changePassword(Request $request){
        $validator = \Validator::make($request->all(), [
            'npassword'=>'required|min:5|max:30',
            'cpassword'=>'required|min:5|max:30|same:npassword'
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=> 0, 'error'=> $validator->errors()->toArray()]);
        } else {
            $user = auth()->user();
            $user->password = \Hash::make($request->npassword);
            $user->save();
            return response()->json(['code'=>1]);
        }
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('main.index');
    }



    //UI

    public function login(){
        return view('main.login');
    }

    public function passwordRecovery(){
        return view('main.password-recovery');
    }


    public function userSettings(){
        $dataUser = User::find(auth()->user()->id);
        $urlPhoto = asset("data/images/upload/users/");
        return view('main.user-settings', [
            'dataUser'=>$dataUser,
            'urlPhoto' => $urlPhoto
        ]);
    }

    public function pageVote(){
        $dataUser = User::find(auth()->user()->id);
        $dataUsers = User::all();
        $dataCandidates = Candidate::all();
        $urlPhoto = asset("data/images/upload/users/");
        $dataSettings = Setting::find(1);
        $checkVote = false;
        if($this->checkVoted(auth()->user()->id)){
            $checkVote = true;
        }
        return view('main.page-vote', [
            'dataUser'=>$dataUser,
            'dataUsers'=>$dataUsers,
            'dataCandidates' => $dataCandidates,
            'urlPhoto' => $urlPhoto,
            'dataSettings' => $dataSettings,
            'checkVote' => $checkVote,
        ]);
    }

    public function friends(){
        $dataUser = User::find(Auth::id());
        $dataFriends = User::all()->except(Auth::id());
        $urlPhoto = asset("data/images/upload/users/");
        return view('main.friends', [
            'dataUser'=>$dataUser,
            'urlPhoto' => $urlPhoto,
            'dataFriends' => $dataFriends
        ]);
    }


    //Tạo phiếu kết quả
    public function createVote(Request $request){

        $id = $request->input('id');
        if(!$this->isOnline($id)){
            return response()->json(['code'=> 0, 'error'=> 'Bầu cử không thành công. Tài khoản không trực tuyến. Không đủ điều kiện bầu cử.']);
        } else {
            if($this->checkVoted($id)){
                return response()->json(['code'=> 0, 'error'=> 'Bầu cử không thành công. Tài khoản đã bầu cử.']);
            } else {
                $dataArray = $request->input('result');
                $vote = new ListVote();
                $vote->user_id = $id;
                $vote->result = $dataArray;
                $vote->save();
                event(new UpdateChange('INACTIVE', $id, 1));
                return response()->json(['code'=> 1, 'success'=> 'Bầu cử thành công!']);
            }

        }
    }

    //Kiểm tra tài khoản đã bỏ phiếu? Trả về true hoặc false
    public function checkVoted(int $id){
        if(ListVote::where('user_id', $id)->exists()){
            return true;
        };
        return false;
    }
    //Kiểm tra tài khoản online hay không? Trả về true hoặc false
    public function isOnline(int $id){
        $user = User::find($id);
        if($user->status == StatusEnum::ACTIVE){
            return true;
        };
        return false;
    }

    //Function gui email dong gop y kien
    public function contributeIdeas(Request $request){
        $emailFrom = 'Guest';
        if($request->input('email')){
            $emailFrom = $request->input('email');
        }
        $ideas = $request->input('ideas');
        $emailTo = 'mirealienbangnga@gmail.com';
        Mail::to($emailTo)->send(new \App\Mail\ContributeIdeas($emailFrom, $ideas));
        return response()->json(['code'=> 1, 'success'=> 'Gửi đóng góp thành công!']);
    }

}
