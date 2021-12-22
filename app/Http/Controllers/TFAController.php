<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnableTFARequest;

class TFAController extends Controller
{

    public function index(){
        $google2fa = app('pragmarx.google2fa');
        $secretKey = $google2fa->generateSecretKey();
        $qrImage = $google2fa->getQRCodeInline(
            config('app.name'),
            request()->user()->email,
            $secretKey
        );
        return view('tfa.index', compact('qrImage', 'secretKey'));
    }

    public function enable(EnableTFARequest $request){
        if($request->user()->two_factor_secret) abort(401);
        $google2fa = app('pragmarx.google2fa');
        $verified = $google2fa->verifyKey($request->secret_key, $request->auth_code);
        if($verified){
            request()->user()->update([
                'two_factor_secret' => $request->secret_key
            ]);
            session()->put(config('auth.tfa'), true);
            session()->flash('success', '2-Step Authentication enabled successfully.');
            return redirect()->route('user.index');
        }
        session()->flash('error', [
            'Wrong authentication code entered.'
        ]);
        return redirect()->back();
    }

    public function disable(){
        request()->user()->update([
            'two_factor_secret' => null
        ]);
        session()->flash('success', '2-Step Authentication disabled successfully.');
        return redirect()->route('user.index');
    }

}
