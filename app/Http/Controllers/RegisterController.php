<?php namespace App\Http\Controllers;

use App\Mail\ConfirmAccountMailable;
use Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller {

    public function userRegisterView() {
        return view('user_register');
    }

    public function userRegister(Request $request) {
        $request->validate([
            'username' => 'string|required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'confirm_token' => Str::random(),
        ]);

        Mail::to($request->input('email'))->send(new ConfirmAccountMailable($user));

        return back()->with('message', 'Registered. Now confirm account');
    }

    public function confirmAccount() {
        $token = request()->input('token');
        $user = User::where('confirm_token', $token)->firstOrFail();

        $user->confirm_token = null;
        $user->save();

        return 'Account confirmed';
    }

    public function becomeAMember() {
        return view('become_a_member');
    }
}