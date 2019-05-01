<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function adminLoginView() {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin');
        }

        return view('admin.login');
    }

    public function adminLogin() {
        $email = request()->input('email');
        $password = request()->input('password');

        if (! Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            return 'wrong details';
        }

        return redirect()->intended('admin');
    }

    public function adminLogout() {
        auth()->guard('admin')->logout();
        return redirect()->route('home');
    }

    public function userLoginView() {
        return view('user_login');
    }

    public function userLogin() {
        $username = request()->input('username');
        $password = request()->input('password');

        if (! Auth::guard('user')->attempt(['username' => $username, 'password' => $password])) {
            return 'wrong details';
        }

        if (User::where('username', $username)->first()->confirm_token) {
            return 'account not confirmed';
        }

        return redirect()->intended('/');
    }

    public function userLogout() {
        auth()->guard('user')->logout();

        return redirect()->route('home');
    }
}