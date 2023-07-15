<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function showLogin()
    {
        return response()->view('Auth/authLogin');
    }
    public function login(Request $request)
    {


            $validator = Validator($request->all(), [
                'email' => 'required|email|exists:admins,email',
                'password' => 'required|string',
                'remember' => 'required|boolean'
            ]);



            if (!$validator->fails()) {
                                            //  هيروح يدور ويفحص التطابق اللي بين البيانات اللي في كريدنشالز و بين البيانات اللي في الجارد
                $credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];
                if (Auth::guard('admin')->attempt($credentials, $request->input('remember'))) {

                    return response()->json(['message' => 'Logged in successfully'], Response::HTTP_OK);
                } else {
                    return response()->json(['message' => 'Login failed, check email or password'], Response::HTTP_BAD_REQUEST);
                }
            }
             else {
                return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
            }

    }



    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->guest(route('orders.create'));
    }



}
