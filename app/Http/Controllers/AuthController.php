<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AuthRequest;
use App\Helper\DAO;
use Session;
use DateTime;
class AuthController extends Controller
{
    /*
     * function login --  get login 
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    public function login(){
        return view('login');
    }
    /*
     * function postLogin -- post login  
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    public function postLogin(AuthRequest $request){
        try {
            $kq = [];
            $params['email']    = $request -> email;
            $params['password'] = $request -> password;
            $result = DAO::executeSql('SPC_USER_RPT1',$params);
            if(isset($result[0]) && !empty($result[0])){
                $this->respon['status']     = NG;
                foreach ($result[0] as $temp) {
                    array_push($this->respon['errors'], $temp);
                }
            }else{

                $dt = new DateTime();
                $time = $dt->format('Y-m-d H:i:s');
                Session::put('time_in',$time);
                Session::put('user',$result[1][0]);
            }
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
         return response()->json($this->respon);
    }

    /*
     * function logout -- logout account 
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */

    public function logout(){
        $id= Session::get('user');
        Session::forget('user');
        $dt = new DateTime();
        $time = $dt->format('Y-m-d H:i:s');
        Session::put('time_out',$time);
        $params['user'] =  $id['user_id'];
        $params['login'] = Session::get('time_in');
        $params['logout'] = Session::get('time_out');
        DAO::executeSql('SPC_SYSTEM_ACT0',$params);
        return redirect()->route('login'); 
    }
}
