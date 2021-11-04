<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Events\ActivePageVote;
use App\Events\UpdateChange;
use App\Events\UpdatePageListUsers;
use App\Imports\UsersImport;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\ListVote;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function login(){
        return view('admin.login');
    }

    public function check(Request $request){
        $this->validate($request,[
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|max:30',
        ]);


        $creds = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($creds)){
            return redirect()->route('admin.dashboard');
        } else {
            return back()->with('fail', __('notifications.ERROR.Check your email and password'));
        }
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function listUsers(){
        $total_users_online = User::where('status', StatusEnum::ACTIVE)->get()->count();
        $total_users_offline = User::where('status', StatusEnum::INACTIVE)->get()->count();
        return view('admin.list-users', [
            'total_users_online' => $total_users_online,
            'total_users_offline' => $total_users_offline,
        ]);
    }

    public function results(){
        $arrayDataCandidates = [];
        $arrayDataVotesPercent = [];

        $total_users_online = User::where('status', StatusEnum::ACTIVE)->get()->count();
        $total_users_vote = ListVote::all()->count();

        $dataUsers = User::all();
        $dataSettings = Setting::find(1);
        $dataCandidates = Candidate::all();
        $votes = ListVote::all();

        foreach ($dataCandidates as $candidate){
            $user = User::where('id', $candidate->user_id)->first();
            array_push($arrayDataCandidates, $user->name);
        }
        for ($i = 0; $i < $dataCandidates->count(); $i++){
            $total_result = 0;
            foreach ($votes as $vote) {
                $result_row = json_decode($vote->result);
                $total_result += (int)$result_row[$i];
            }
            array_push($arrayDataVotesPercent, round($total_result/$total_users_online*100, 2));
        }

        return view('admin.results', [
            'arrayDataCandidates'=> $arrayDataCandidates,
            'arrayDataVotesPercent' => $arrayDataVotesPercent,
            'total_users_online' => $total_users_online,
            'total_users_vote' => $total_users_vote,
            'dataCandidates' => $dataCandidates,
            'dataUsers' => $dataUsers,
            'dataSettings' => $dataSettings,
        ]);
    }

    public function settingsPageVote(){
        $dataSettings = Setting::find(1);
        return view('admin.settings-page-vote', [
            'dataSettings' => $dataSettings,
        ]);
    }

    //Hàm xử lý lấy thông tin của tất cả users
    public function getAllUsers(Request $request){
        if ($request->ajax()) {

            $data = User::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($user) {
                    $url=asset("data/images/upload/users/$user->image");
                    return '<img src="'.$url.'" class="avatar avatar-xl" width="50" height="50" alt=""/></div>';
                })
                ->editColumn('status', function ($user) {
                    if($user->status == StatusEnum::ACTIVE){
                        return '<div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" onchange="changeStatusAccount(this)" user-id="'.$user->id.'" checked>
                                    <label class="form-check-label" id="switch-status-'.$user->id.'">Tham dự</label>
                                </div>';
                    } else {
                        return '<div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" onchange="changeStatusAccount(this)" user-id="'.$user->id.'">
                                    <label class="form-check-label" id="switch-status-'.$user->id.'">Vắng</label>
                                </div>';
                    }
                })
                ->addColumn('action', function($user){

                    $actionBtn = '';
                    if($this->isCandidate($user->id)){
                        $actionBtn .= '
                                <button class="btn btn-sm btn-success rounded-pill" id="button-action-'.$user->id.'" onclick="removeCandidate('.$user->id.')">Đã là ứng viên</button>
                        ';
                    }else{
                        $actionBtn .= '
                                <button class="btn btn-sm btn-secondary rounded-pill" id="button-action-'.$user->id.'" onclick="addCandidate('.$user->id.')">Chọn là ứng viên</button>
                        ';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['image','status', 'action'])
                ->make(true);
        }
    }

    public function getAllCandidates(Request $request){
        if ($request->ajax()) {

            $data = Candidate::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($candidate) {
                    $user = User::where('id', $candidate->user_id)->first();
                    $url=asset("data/images/upload/users/$user->image");
                    return '<img src="'.$url.'" class="avatar avatar-xl" width="50" height="50" alt=""/></div>';
                })
                ->editColumn('name', function ($candidate) {
                    $user = User::where('id', $candidate->user_id)->first();
                    return $user->name;
                })
                ->addColumn('action', function($candidate){
                    $user = User::where('id', $candidate->user_id)->first();
                    $actionBtn = '
                        <button class="btn btn-sm btn-danger rounded-pill remove-candidate" id="button-action-'.$user->id.'" onclick="removeCandidate('.$user->id.')">Xóa ứng viên</button>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['image','name', 'action'])
                ->make(true);
        }
    }

    public function getAllVotes(Request $request){
        if ($request->ajax()) {

            $data = ListVote::all();
            $dataCandidates = Candidate::all();
            $array = [];
            $DBT = Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function($vote) use ($array) {
                    array_push($array, 'id');
                    return uniqid('mirea-'.$vote->user_id);
                });
            $count = -1;
            foreach($dataCandidates as $candidate){
                $count += 1;
                $user = User::where('id', $candidate->user_id)->first();
                $DBT->editColumn($user->id, function ($vote) use ($user, $array, $count) {
                        array_push($array, $user->id);
                        //Decode array từ database
                        //Log::info(json_decode($vote->result)[$count]);
                        if(json_decode($vote->result)[$count] === 1){
                            return 'VOTE';
                        }else {
                            return 'UNVOTE';
                        }
                    });
            }
            return $DBT->rawColumns($array)->make(true);
        }
    }

    //Kiểm tra có phải là ứng viên hay không? Trả về true hoặc false
    public function isCandidate(int $user_id){
        if(Candidate::where('user_id', $user_id)->exists()){
            return true;
        };
        return false;
    }

    //Hàm xử lý thay đổi số lượng ứng viên nhận vào và ứng viên tham gia
    public function setQty(Request $request){
        $this->validate($request,[
            'qty_receive'=>'required|numeric|min:0|not_in:0',
            'qty_total'=>'required|numeric|min:0|not_in:0',
        ]);
        $setting = Setting::find(1);
        $setting->qty_receive = $request->input('qty_receive');
        $setting->qty_total = $request->input('qty_total');
        $setting->save();
        return back()->with('success', 'Quantity changed successfully!');
    }

    //Hàm xử lý set giá trị trạng thái của tất cả các tài khoản
    public function setStatusAllUsers(Request $request){


        $status = $request->input('status');
        $users = User::all();
        foreach ($users as $user){
            $user->status = $status;
            $user->save();
            event(new UpdateChange($status, $user->id, 0));
        }
        $total_users_online = User::where('status', StatusEnum::ACTIVE)->get()->count();
        $total_users_offline = User::where('status', StatusEnum::INACTIVE)->get()->count();
        event(new UpdatePageListUsers( $total_users_online, $total_users_offline));
        return back()->with('success', 'Status changed successfully!');
    }

    //Hàm xử lý set giá trị trạng thái của một tài khoản
    public function setStatusUser(Request $request){
        $status = $request->input('status');
        $user = User::find($request->input('id'));
        $user->status = $status;
        $user->save();
        event(new UpdateChange($status, $user->id, 0));
        $total_users_online = User::where('status', StatusEnum::ACTIVE)->get()->count();
        $total_users_offline = User::where('status', StatusEnum::INACTIVE)->get()->count();
        event(new UpdatePageListUsers( $total_users_online, $total_users_offline));
        return back()->with('success', 'Status changed successfully!');
    }

    //Hàm xử lý set giá trị trạng thái của trang bầu cử
    public function setStatusPageVote(Request $request){
        $status = $request->input('status');
        $setting = Setting::find(1);
        $setting->status = $status;
        $setting->save();
        event(new UpdateChange($status, Auth::user()->id, 1));
        return back();
    }

    //Hàm xử lý set giá trị trạng thái của trang bầu cử INACTIVE
    public function setStatusPageVoteINACTIVE(){
        $status = StatusEnum::INACTIVE;
        $setting = Setting::find(1);
        $setting->status = $status;
        $setting->save();
        event(new UpdateChange($status, Auth::user()->id, 1));
    }


    //Hàm xử lý reset bảng những ứng viên
    public function resetCandidates(){
        Candidate::truncate();
        $this->resetResultVotes();
        $this->setStatusPageVoteINACTIVE();
        return back()->with('success', 'Table candidates has been reset successfully!');
    }

    public function resetResultVotes(){
        ListVote::truncate();
    }

    //Hàm xử lý thêm ứng viên
    public function addCandidate(Request $request){
        $candidate = new Candidate();
        $candidate->user_id = $request->input('id');
        $candidate->save();
        return response()->json(['code'=>1, 'msg' => 'Success']);
    }

    //Hàm xử lý xóa ứng viên
    public function removeCandidate(Request $request){
        $user_id = $request->input('id');
        $candidate = Candidate::where('user_id', $user_id);
        $candidate->delete();
        return response()->json(['code'=>1, 'msg' => 'Success']);
    }

    //Hàm nhập dữ liệu từ excel để tạo tài khoản
    public function importUserCreate(Request $request){
        $this->validate($request, [
            'select_file' => 'required|mimes:xls,xlsx'
        ]);

        if($request->input('select') == 'refesh'){
            User::truncate();
        }

        Excel::import(new UsersImport, $request->file('select_file'));
        return back()->with('success', 'Excel data imported successfully!');
    }

    //Hàm xử lý kết quả
    public function showResult(){
        $arrayDataCandidates = [];
        $arrayDataVotes = [];

        $dataSettings = Setting::find(1);
        $candidates = Candidate::all();
        $votes = ListVote::all();

        foreach ($candidates as $candidate){
            $user = User::where('id', $candidate->user_id)->first();
            array_push($arrayDataCandidates, $user->name);
        }
        for ($i = 0; $i < $candidates->count(); $i++){
            $total_result = 0;
            foreach ($votes as $vote) {
                $result_row = json_decode($vote->result);
                $total_result += (int)$result_row[$i];
            }
            array_push($arrayDataVotes, $total_result);
        }

        return response()->json(['code'=> 1,
            'arrayDataCandidates'=> $arrayDataCandidates,
            'arrayDataVotes' => $arrayDataVotes
        ]);
    }
}
