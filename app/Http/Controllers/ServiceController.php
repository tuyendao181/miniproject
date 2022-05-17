<?php

namespace App\Http\Controllers;
use App\Helper\DAO;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    public function getService(Request $request){
        $user = Session::get('user');
        $data['user_id']= $user['user_id'];
        $data = array_merge($this->paginateService($request),$data);
        return view('system.list_service',compact('data'));
    }
    //paginate
    public function paginateService(Request $request){
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

        $result = DAO::executeSql('SPC_SERVICE_FND1',$params);
        $data['data']=$result[0];
        $data['paginate'] = $result[1][0];
        if($request->ajax()){
            return view('system.list_service_ajax',compact('data'));
        }else{
            return  $data;
        }
       
    }
    // refer data edit 
    public function geditService(Request $request ){
        try{   
            $param['id'] = $request->id;
            $result = DAO::executeSql('SPC_SERVICE_INQ_1',$param);
            $this->respon['data'] = $result[0][0];
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
    // add data
    public function postService(ServiceRequest $request){
        try {   
            $kq=[];
            $params['id'] = $request->id;
            $params['service'] = $request->service;
            $params['price'] = $request->price;
            $params['userId']= $request->userId;
            $result = DAO::executeSql('SPC_SERVICE_ACT0',$params);
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
    public function putService(Request $request){
        try { 
            $kq=[];
            $data['data'] = json_decode($request->myArray, true);
            $mess =  [
                'data.*.name.required'  => '1',
                'data.*.price.required' => '1',
                'data.*.price.numeric'  => '3',
                'data.*.id.required'    => '1',
            ];
            $validator = Validator::make($data, [
                'data.*.name'         => 'required',
                'data.*.price'        => 'required|numeric',
                'data.*.id'           => 'required',
            ],$mess);
           
            if ($validator->fails()) {
             
                $this->respon['status'] = NG;
                $error = $validator -> errors()->toArray(); 
                foreach($error as $key => $vla){
                    $this->respon['errors'][substr($key,7)]=$vla[0];
                }
            }else{
                $param = $request->all();
                $result = DAO::executeSql('SPC_SERVICE_ACT1',$param);
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
    public function patchService(ServiceRequest $request){
        try {   
            $kq=[];
            $params['id'] = $request->id;
            $params['service'] = $request->service;
            $params['price'] = $request->price;
            $params['userId']= $request->userId;
            $result = DAO::executeSql('SPC_SERVICE_ACT2',$params);
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
