<?php namespace App\Http\Controllers;

use App\User;

class MailTemplatesController extends Controller {
    public function confirm() {
        $user = new User;
        $user->username = 'sami';
        $user->confirm_token = 12345678910;
        $user->email = 'phpdevsami@gmail.com';

        return view('mail.account_confirm', ['user' => $user]);
    }
}