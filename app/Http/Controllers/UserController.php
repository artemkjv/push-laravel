<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index(){
        return view('user.index');
    }

    public function changePassword(ChangePasswordRequest $request){
        $request->user()->update([
            'password' => Hash::make($request->password)
        ]);
        session()->flash('success', 'Password has been changed successfully.');
        return redirect()->route('user.index');
    }

    public function regenerateToken(){
        $token = Str::random(60);
        request()->user()->update([
            'api_token' => hash('sha256', $token)
        ]);
        session()->flash('success', 'Token has been generated successfully.');
        return redirect()->route('user.index');
    }

}
