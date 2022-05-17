<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AuthRequest;
use App\Helper\DAO;
use Session;
class AuthController extends Controller
{
    //
    public function login(){
        return view('login');
    }
    public function postLogin(AuthRequest $request){
        try {
            $kq = [];
            $params['email']    = $request -> email;
            $params['password'] = $request -> password;
            $result = DAO::executeSql('SPC_USER_RPT1',$params);
           
            if(isset($result[0]) && empty($result[0])){
                $this->respon['errors']  = 'Tài khoản mật khẩu không đúng';
            }
            else{
                Session::put('user',$result[0][0]);
            }
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
         return response()->json($this->respon);
    }
}
