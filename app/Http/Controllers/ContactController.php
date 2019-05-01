<?php namespace App\Http\Controllers;

use App\Contact;
use App\Mail\ContactMailable;
use App\Mail\OrderConfirmMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller {
    public function index() {
        return view('contact');
    }

    public function send(Request $request) {
        $rules = [];

        $rules['email'] = 'email';
        $rules['message'] = 'required';

        if (! auth()->guard('user')->check()) {
            $rules['username'] = 'required';
        }

        $request->validate($rules);

        $to = 'phpdevsami@gmail.com';
        $from = $to;
        $username = isset(auth()->guard('user')->user()->username) ? auth()->guard('user')->user()->username : request()->input('username');
        $email = request()->input('email');
        $message = request()->input('message');

        $data = compact('to','from', 'username', 'email', 'message');

        $this->log($data);
        Mail::to($email)->send(new ContactMailable($data));

        return redirect()->back()->with('message', 'Your email has been received, we will contact you soon');
    }

    public function log($data) {
        Contact::create(['username' => $data['username'], 'email' => $data['email'], 'message' => $data['message']]);
    }
}
