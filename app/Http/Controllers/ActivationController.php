<?php

namespace App\Http\Controllers;

use App\ActivationCode;
use App\Mail\ActivationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Mail;

class ActivationController extends Controller
{
    public function activation(ActivationCode $code)
    {

        // update the activate field in the database
        $code->user()->update([
            'active' => true
        ]);

        // delete the code
        $code->delete();

        // login the user
        Auth::login($code->user);

        // redirect the home page
        return redirect('/home')->with('toast_success', 'Your account has been activated');
    }

    public function codeResend(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();

        if ($user->is_activated) {
            return redirect('/home')->with('toast_success', 'Welcome ' . $user->name);
        }

        Mail::to($user)->queue(new ActivationEmail($user->userActivationCode));

        return redirect('/login')->with('toast_success', 'An email has been sent to your account');
    }
}
