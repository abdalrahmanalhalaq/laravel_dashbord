<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class restePasswordController extends Controller
{
    //
    public function forgotPassword(Request $request)
    {
        return response()->view('Auth.forgot-password');
    }
    public function sendRestEmail(Request $request)
    {

    }
}
