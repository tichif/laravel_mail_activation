<?php

namespace App\Http\Controllers;

use App\ActivationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    public function activation(ActivationCode $code)
    {

        // update the activate field in the database
        $code->user()->update([
            'activate' => true
        ]);

        // delete the code
        $code->delete();

        // login the user
        Auth::login($code->user);

        // redirect the home page
        return redirect('/home')->with('toast_success', 'Your account has been activated');
    }
}
