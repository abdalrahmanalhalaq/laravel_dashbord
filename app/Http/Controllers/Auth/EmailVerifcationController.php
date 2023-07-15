<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailVerifcationController extends Controller
{
    //
    public function notice()
    {
        return response()->view('Auth.verify-notice');
    }
    // / // / // / // / // / // /
    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'verification send successfully'] ,Response::HTTP_OK);
    }

    public function verify(EmailVerificationRequest $request)
    {
    $request->fulfill();         // الدالة المسؤولة عن تفعيل الايميل
    return redirect('/admins');
    }
}
