<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    //
    public function login(){
        return view('login');
    }
    public function postLogin(AuthRequest $request){
        $dt=Account::WHERE([
            'user'=>$request->email,
            'password'=>md5($request->password)
        ])->first();
    }
}
