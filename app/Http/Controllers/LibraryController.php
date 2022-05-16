<?php

namespace App\Http\Controllers;
use App\Helper\DAO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LibraryRequest;


class LibraryController extends Controller
{
    public function getLibrary(){
        $result = DAO::executeSql('SPC_LIBRARY_LST_1');
        return view('system.list_library',compact('result'));
    }
    public function geditLibrary(Request $request ){
        try{   
            $param['id'] = $request->id;
            $result = DAO::executeSql('SPC_LIBRARY_INQ_1',$param);
            $this->respon['data'] = $result[0][0];
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
    public function postLibrary(LibraryRequest $request){
        try {   
            $kq=[];
            $params['id'] = $request->id;
            $params['section'] = $request->section;
            $params['value'] = $request->value;
            $result = DAO::executeSql('SPC_LIBRARY_ACT0',$params);
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
    public function putLibrary(Request $request){
        try { 
            $kq=[];
            $data['data'] = json_decode($request->myArray, true);
            $mess =  [
                'data.*.value.required' => '1',
                'data.*.section.required' => '1',
                'data.*.id.required' => '1',
            ];
            $validator = Validator::make($data, [
                'data.*.value'         => 'required',
                'data.*.section'       => 'required',
                'data.*.id'            => 'required',
            ],$mess);
           
            if ($validator->fails()) {
             
                $this->respon['status'] = NG;
                $error = $validator -> errors()->toArray(); 
                foreach($error as $key => $vla){
                    $this->respon['errors'][substr($key,7)]=$vla[0];
                }
            }else{
                $param = $request->all();
                $result = DAO::executeSql('SPC_LIBRARY_ACT1',$param);
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

    public function patchLibrary(LibraryRequest $request){
        try {   
            $kq=[];
            $params['id'] = $request->id;
            $params['section'] = $request->section;
            $params['value'] = $request->value;
            $result = DAO::executeSql('SPC_LIBRARY_ACT2',$params);
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
