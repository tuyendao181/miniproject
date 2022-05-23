<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\DAO;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
use Session;

class UserController extends Controller
{
    public function listUser(){
        $result['data'] = DAO::executeSql('SPC_USER_LST_1');
        $result['gender'] = DAO::executeSql('SPC_LIBRARY_INQ_2');
        $user = Session::get('user','user_id');
        $result['user_id']= $user['user_id'];
        return view('system.list_user',compact('result'));
    }
    public function addUser(UserRequest $request){
        try { 
             $params['name']       = $request -> name ; 
             $params['date_birth'] = $request -> date_birth ; 
             $params['gender']     = $request -> gender ; 
             $params['phone']      = $request -> phone ; 
             $params['email']      = $request -> email ; 
             $params['password']   = $request -> password; 
             $params['address']    = $request -> address ; 
              if ($request->hasFile('avatar') != "") {
                   $file = $request->file('avatar');
                   #c1 lay ten file
                   // $filename = $file->getClientOriginalName(); 
                   #đôi tên file vì server
                   $filename = time().'.'.$file ->extension();
                   # Location
                   $pathname = 'uploads/' . date("Y") . '/' . date("m") . '/';

                   if (!is_dir($pathname)) {
                       mkdir($pathname, 0777, true);
                   }
                   # Upload file
                   $file->move($pathname, $filename);   
                   $filenamemain = date("Y") . '/' . date("m") . '/' .$filename;
               }
               else{
                   $filenamemain ='';
               }
               $params['avatar']   = $filenamemain ; 
              
             $result = DAO::executeSql('SPC_USER_ACT0',$params);
             if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                 $this->respon['status']     = EX;
                 $this->respon['Exception']  = $result[0][0]['remark'];
             }else if(isset($result[0]) && !empty($result[0])){
                 $this->respon['status']     = NG;
                 foreach ($result[0] as $temp) {
                    array_push($kq,$temp);
                 }
                 foreach ( $kq as $vla) {
                    //one key one mess
                    $this->respon['errors'][$vla['item']][0]=$kq[0]['message_no'];
                 } 
             }
        
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
         return response()->json($this->respon);
    }
    public function editUser(UserRequest $request){
        try { 
             $params['id']         = $request -> id ; 
             $params['userId']     = $request -> userId ; 
             $params['name']       = $request -> name ; 
             $params['date_birth'] = $request -> date_birth ; 
             $params['gender']     = $request -> gender ; 
             $params['phone']      = $request -> phone ; 
             $params['email']      = $request -> email ; 
             $params['password']   = $request -> password; 
             $params['address']    = $request -> address ; 
            if ($request->hasFile('avatar') != "") {
                   $file = $request->file('avatar');
                   #c1 lay ten file
                   // $filename = $file->getClientOriginalName(); 
                   #đôi tên file vì server
                   $filename = time().'.'.$file ->extension();
                   # Location
                   $pathname = 'uploads/' . date("Y") . '/' . date("m") . '/';

                   if (!is_dir($pathname)) {
                       mkdir($pathname, 0777, true);
                   }
                   # Upload file
                   $file->move($pathname, $filename);   
                   $filenamemain = date("Y") . '/' . date("m") . '/' .$filename;
               }
               else{
                   $filenamemain ='';
               }
               $params['avatar']   = $filenamemain ; 
              
             $result = DAO::executeSql('SPC_USER_ACT2',$params);
             if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                 $this->respon['status']     = EX;
                 $this->respon['Exception']  = $result[0][0]['remark'];
             }else if(isset($result[0]) && !empty($result[0])){
                 $this->respon['status']     = NG;
                 foreach ($result[0] as $temp) {
                    array_push($kq,$temp);
                 }
                 foreach ( $kq as $vla) {
                    //one key one mess
                    $this->respon['errors'][$vla['item']][0]=$kq[0]['message_no'];
                 } 
             }
        
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
         return response()->json($this->respon);
    }

    public function deletetUser(Request $request){
       try{
            $params['id']    = $request->id;
            $params['user']  = $request->user;
            DAO::executeSql('SPC_USER_ACT3',$params);
       } catch(\Exception $e) {
           $this->respon['status']     = EX;
           $this->respon['Exception']  = $e->getMessage();
       }
        return response()->json($this->respon);
    }

      // refer data edit 
      public function referUser(Request $request ){
        try{  
            $param['id'] = $request->id;
            $result = DAO::executeSql('SPC_USER_INQ_1',$param);
            $this->respon['data'] = $result[0][0];
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
    
}
