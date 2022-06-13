<?php

namespace App\Http\Controllers;
use App\Helper\DAO;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\MedicinesRequest;
class MedicinesController extends Controller
{
    /*
     * function getMedicines -- list data
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function getMedicines(Request $request){
       
        $user = Session::get('user');
        $data['user_id']= $user['user_id'];
        $data = array_merge($this->paginateMedicines($request),$data);
        return view('system.list_medicines',compact('data'));
    }
    
    /*
     * function paginateMedicines -- paginate
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function paginateMedicines(Request $request){
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

        $result = DAO::executeSql('SPC_MEDICINES_FND1',$params);
        $data['data']=$result[0];
        $data['paginate'] = $result[1][0];
        if($request->ajax()){
            return view('system.list_medicines_ajax',compact('data'));
        }else{
            return  $data;
        }
       
    }
 
    /*
     * function listMail --  refer data edit
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function geditMedicines(Request $request ){
        try{   
            $param['id'] = $request->id;
            $result = DAO::executeSql('SPC_MEDICINES_INQ_1',$param);
            $this->respon['data'] = $result[0][0];
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
    /*
     * function postMedicines -- add data
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function postMedicines(MedicinesRequest $request){
        try {   

            $kq=[];
            $params['id'] = $request->id;
            $params['medicines'] = $request->medicines;
            $params['price'] = $request->price;
            $params['userId']= $request->userId;
            $result = DAO::executeSql('SPC_MEDICINES_ACT0',$params);
            if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                $this->respon['status']     = EX;
                $this->respon['Exception']  = $result[0][0]['remark'];
            }else if(isset($result[0]) && !empty($result[0])){
                $this->respon['status']     = NG;
                foreach ($result[0] as $temp) {
                    array_push($this->respon['errors'], $temp);
                }
            }
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }

        return response()->json($this->respon);
    }
    /*
     * function putMedicines -- delete edit data json
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function putMedicines(Request $request){
        try { 
            $kq=[];
            $data['data'] = json_decode($request->myArray, true);

            $mess=[];
            // dd($data['data']);
            foreach($data['data'] as $key => $value){
                $id = $value['id'];
               
                foreach($value as $k => $item){
                    if($k == 'price'){
                        $mess["data.$key.$k.required"] = ["$id",'1'] ;
                        $mess["data.$key.$k.numeric"]  = ["$id",'3'] ;
                    }else{
                        $mess["data.$key.$k.required"] = ["$id",'1'] ;
                    }
                   
                }
            }
            $validator = Validator::make($data, [
                'data.*.medicines'         => 'required',
                'data.*.price'             => 'required|numeric',
                'data.*.id'                => 'required',
            ],$mess);
           
            if ($validator->fails()) {
                $this->respon['status'] = NG;
                $error = $validator -> errors()->toArray(); 
               
                //one 1 value
                foreach($error as $key => $item){
                    $index = strpos($key,".") + 3;  //find
                    $temp = [
                        'item'       =>substr($key,$index), //trim
                        'message_no' => $item[0][1],// key one mess
                        'error_typ'  => 2,
                        'value1'     => $item[0][0]  //position row
                    ];
                    array_push($this->respon['errors'], $temp);  
                }
            }else{
                $param = $request->all();
                $result = DAO::executeSql('SPC_MEDICINES_ACT1',$param);
                if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                    $this->respon['status']     = EX;
                    $this->respon['Exception']  = $result[0][0]['remark'];
                }else if(isset($result[0]) && !empty($result[0])){
                    $this->respon['status']     = NG;
                    foreach ($result[0] as $temp) {
                        array_push($this->respon['errors'], $temp);
                    }
                }
            }
           
         } catch(\Exception $e) {
             $this->respon['status']     = EX;
             $this->respon['Exception']  = $e->getMessage();
         }
          return response()->json($this->respon);
    }
    /*
     * function patchMedicines -- edit one data
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function patchMedicines(MedicinesRequest $request){
        try {

            $kq=[];
            $params['id'] = $request->id;
            $params['medicines'] = $request->medicines;
            $params['price'] = $request->price;
            $params['userId']= $request->userId;
            $result = DAO::executeSql('SPC_MEDICINES_ACT2',$params);
            if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                $this->respon['status']     = EX;
                $this->respon['Exception']  = $result[0][0]['remark'];
            }else if(isset($result[0]) && !empty($result[0])){
                $this->respon['status']     = NG;
                foreach ($result[0] as $temp) {
                    array_push($this->respon['errors'], $temp);
                }
            }
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
   
}
