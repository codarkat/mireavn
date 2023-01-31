<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLoginForm extends Component
{
    public $login_id, $password;
    public function LoginHandler()
    {
        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if ($fieldType == 'email') {
            $this->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:5',
            ], [
                'login_id' => 'Email or Username is required',
                'login_id.email' => 'Invalid email address',
                'login_id.exists' => 'The email is not registered',
                'password.required' => 'The password is required',
            ]);
        } else {
            $this->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5',
            ], [
                'login_id.required' => 'Email or Username is required',
                'login_id.exists' => 'The username is not registered',
                'password.required' => 'The password is required',
            ]);
        }

        $creds = array($fieldType => $this->login_id, 'password' => $this->password);

        if (Auth::guard('web')->attempt($creds)) {
            $checkUser = User::where($fieldType, $this->login_id)->first();
            if ($checkUser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('admin.login')->with('fail', 'Your account has been blocked.');
            } else {
                return redirect()->route('admin.home');
            }
        } else {
            session()->flash('fail', 'Incorrect Email/Username or Password');
        }
    }
    public function render()
    {
        return view('livewire.admin-login-form');
    }
}