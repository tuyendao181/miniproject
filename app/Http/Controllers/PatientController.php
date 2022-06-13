<?php

namespace App\Http\Controllers;
use App\Helper\DAO;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PatientRequest;

class PatientController extends Controller
{
    /*
     * function getPatient -- list data
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function getPatient(Request $request){
        $user = Session::get('user');
        $data['user_id']= $user['user_id'];
        $data['gender']     = DAO::executeSql('SPC_LIBRARY_INQ_2');
        $data['blood_type'] = DAO::executeSql('SPC_LIBRARY_INQ_4');
        $data = array_merge($this->paginatePatient($request),$data);
        return view('ex_health.list_patient',compact('data'));
    }
    /*
     * function paginatePatient -- paginate
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function paginatePatient(Request $request){
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

        $result = DAO::executeSql('SPC_PATIENT_FND1',$params);
        $data['data']=$result[0];
        $data['paginate'] = $result[1][0];
        $data['gender']     = DAO::executeSql('SPC_LIBRARY_INQ_2');
        $data['blood_type'] = DAO::executeSql('SPC_LIBRARY_INQ_4');
        if($request->ajax()){
            return view('ex_health.list_patient_ajax',compact('data'));
        }else{
            return  $data;
        }
       
    }
    /*
     * function geditPatient -- refer data edit 
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function geditPatient(Request $request ){
        try{  
            $param['id'] = $request->id;
            $result = DAO::executeSql('SPC_PATIENT_INQ_1',$param);
            $this->respon['data'] = $result[0][0];
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
    // add data
    /*
     * function putMedicines -- add data
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function postPatient(PatientRequest $request){
        try {  
            $kq=[];
            $params['name']         = $request->name;
            $params['birth_day']    = $request->birth_day;
            $params['gender']       = $request->gender;
            $params['blood_type']   = $request->blood_type;
            $params['phone']        = $request->phone;
            $params['email']        = $request->email;
            $params['address']      = $request->address;
            $params['cmnd']         = $request->cmnd;
            $params['userId']       = $request->userId;
            $result = DAO::executeSql('SPC_PATIENT_ACT0',$params);
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
    /*
     * function putPatient -- delete edit data json
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function putPatient(Request $request){
        try { 
            
            $kq=[];
            $data['data'] = json_decode($request->myArray, true);
            $mess=[];
            // dd($data['data']);
            foreach($data['data'] as $key => $value){
                $id = $value['id'];
                foreach($value as $k => $item){
                    $mess["data.$key.$k.required"] = ["$id",'1'] ;
                    $mess["data.$key.$k.date"] = ["$id",'3'] ;
                    $mess["data.$key.$k.integer"] = ["$id",'3'] ;
                    $mess["data.$key.$k.email"] = ["$id",'3'] ;
                }
            }
            $validator = Validator::make($data, [
                'data.*.name'           => 'required',
                'data.*.birthday'       => 'required|date',
                'data.*.address'        => 'required',
                'data.*.gender'         => 'required',
                'data.*.phone'          => 'required|integer',
                'data.*.email'          => 'required|email',
                'data.*.email'          => 'required|email',
                'data.*.blood_type'     => 'required',
                'data.*.cmnd'           => 'required',
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
                $result = DAO::executeSql('SPC_PATIENT_ACT1',$param);
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
     * function patchPatient --edit one data
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function patchPatient(PatientRequest $request){
        try {   
            $kq=[];
            $params['id']           = $request->id;
            $params['name']         = $request->name;
            $params['birth_day']    = $request->birth_day;
            $params['gender']       = $request->gender;
            $params['blood_type']   = $request->blood_type;
            $params['phone']        = $request->phone;
            $params['email']        = $request->email;
            $params['address']      = $request->address;
            $params['cmnd']         = $request->cmnd;
            $params['userId']       = $request->userId;
            $result = DAO::executeSql('SPC_PATIENT_ACT2',$params);
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
