<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(LoginRequest $request)
    {
        if (Auth::attempt($request->except(['_token','remember']))) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'user') {
                return redirect()->intended('/');
            }else{
                return redirect('admin-dashboard');
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function changePass(ChangePasswordRequest $request)
    {
        User::find(Auth::user()->id)
        ->update(["password" => bcrypt($request->new_password)]);
        return response()->json(["status"=>"success","message"=>"Password Updated"]); 
    }

    public function resetPass($id)
    {
        User::find($id)
        ->update(["password" => bcrypt("defaultpass123")]);
        return response()->json(["status"=>"success","message"=>"Password Reset"]); 
    }
}
