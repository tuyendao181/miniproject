<?php

namespace App\Http\Controllers;
use App\Helper\DAO;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\DoctorRequest;

class DoctorController extends Controller
{
    public function getDoctor(Request $request){
        $user = Session::get('user','user_id');
        $data['user_id']= $user['user_id'];
        $data['gender'] = DAO::executeSql('SPC_LIBRARY_INQ_2');
        $data = array_merge($this->paginateDoctor($request),$data);
        return view('system.list_doctor',compact('data'));
    }
    //paginate
    public function paginateDoctor(Request $request){
        if(empty($request->curent)){
            $params['curent'] = 1;
        }
        else{
            $params['curent']= $request->curent;
        }
        if(empty($request->limit)){
            $params['limit'] = 5;
        }
        else{
            $params['limit'] = $request->limit;
        }

        $result = DAO::executeSql('SPC_DOCTOR_FND1',$params);
        $data['data']=$result[0];
        $data['paginate'] = $result[1][0];
        $data['gender'] = DAO::executeSql('SPC_LIBRARY_INQ_2');
        if($request->ajax()){
            return view('system.list_doctor_ajax',compact('data'));
        }else{
            return  $data;
        }
       
    }
    // refer data edit 
    public function geditDoctor(Request $request ){
        try{  
            $param['id'] = $request->id;
            $result = DAO::executeSql('SPC_DOCTOR_INQ_1',$param);
            $this->respon['data'] = $result[0][0];
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
    // add data
    public function postDoctor(DoctorRequest $request){
        try {  
            $kq=[];
            $params['name']         = $request->name;
            $params['date_birth']   = $request->date_birth;
            $params['gender']       = $request->gender;
            $params['phone']        = $request->phone;
            $params['email']        = $request->email;
            $params['address']      = $request->address;
            $params['userId']       = $request->userId;
            $result = DAO::executeSql('SPC_DOCTOR_ACT0',$params);
            if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                $this->respon['status']     = EX;
                $this->respon['Exception']  = $result[0][0]['remark'];
            }else if(isset($result[0]) && !empty($result[0])){
                $this->respon['status']     = NG;
                foreach ($result[0] as $temp) {
                   array_push($kq, $temp);
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
    //save data
    public function putDoctor(Request $request){
        try { 
          
            $kq=[];
            $data['data'] = json_decode($request->myArray, true);
            $mess =  [
                'data.*.name.required'     => '1',
                'data.*.birthday.required' => '1',
                'data.*.birthday.date'     => '3',
                'data.*.address.required'  => '1',
                'data.*.gender.required'   => '1',
                'data.*.phone.required'    => '1',
                'data.*.phone.integer'     => '3',
                'data.*.email.required'    => '3',
                'data.*.email.email'       => '3',
            ];
            $validator = Validator::make($data, [
                'data.*.name'           => 'required',
                'data.*.birthday'       => 'required|date',
                'data.*.address'        => 'required',
                'data.*.gender'         => 'required',
                'data.*.phone'          => 'required|integer',
                'data.*.email'          => 'required|email',
            ],$mess);
           
            if ($validator->fails()) {
             
                $this->respon['status'] = NG;
                $error = $validator -> errors()->toArray(); 
                foreach($error as $key => $vla){
                    $this->respon['errors'][substr($key,7)]=$vla[0];
                }
            }else{
                $param = $request->all();
                $result = DAO::executeSql('SPC_DOCTOR_ACT1',$param);
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
            }
           
         } catch(\Exception $e) {
             $this->respon['status']     = EX;
             $this->respon['Exception']  = $e->getMessage();
         }
          return response()->json($this->respon);
    }
    //edit one data
    public function patchDoctor(DoctorRequest $request){
        try {   
            $kq=[];
            $params['id']           = $request->id;
            $params['name']         = $request->name;
            $params['date_birth']   = $request->date_birth;
            $params['gender']       = $request->gender;
            $params['phone']        = $request->phone;
            $params['email']        = $request->email;
            $params['address']      = $request->address;
            $params['userId']       = $request->userId;
            $result = DAO::executeSql('SPC_DOCTOR_ACT2',$params);
            if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                $this->respon['status']     = EX;
                $this->respon['Exception']  = $result[0][0]['remark'];
            }else if(isset($result[0]) && !empty($result[0])){
                $this->respon['status']     = NG;
                foreach ($result[0] as $temp) {
                   array_push($kq, $temp);
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
}
