<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\TFALoginRequest;

class TFAController
{

    public function index(){
        if(is_null(request()->user()->two_factor_secret)) abort(401);
        return view('auth.tfa.index');
    }

    public function login(TFALoginRequest $request){
        if(is_null(request()->user()->two_factor_secret)) abort(401);
        $google2fa = app('pragmarx.google2fa');
        $verified = $google2fa->verifyKey($request->user()->two_factor_secret, $request->auth_code);
        if($verified){
            session()->put(config('auth.tfa'), true);
            return redirect()->route('home');
        }
        session()->flash('error', [
            'Wrong authentication code entered.'
        ]);
        return redirect()->back();
    }

}
