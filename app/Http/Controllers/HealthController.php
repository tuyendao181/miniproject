<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Helper\DAO;
use session;
use PDF;
class HealthController extends Controller
{
    public function getHealth(){
        try{  
            $result = DAO::executeSql('SPC_PATIENT_LST_1');
            $service = DAO::executeSql('SPC_SERVICE_INQ_2');
            $doctor = DAO::executeSql('SPC_DOCTOR_INQ_2');
            $medicines = DAO::executeSql('SPC_MEDICINES_INQ_3');
            $this->respon['data'] = $result[0];
            $this->respon['service'] = $service[0];
            $this->respon['doctor'] = $doctor[0];
            $this->respon['medicines'] = $medicines[0];
            
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
    public function referHealth(Request $request){
        try{  
            $param['id'] = $request->id;
            $result = DAO::executeSql('SPC_PATIENT_LST_2',$param);
            $this->respon['data'] = $result[0][0];
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
    public function saveHealth(Request $request){
        try{  
            $data['data_1'] = $request->diagnosis;
            $data['data_2'] = json_decode($request->diagnosis_detail, true);
            $mess =  [
                'data_1.*.patient.required'   => '1',
                'data_1.*.doctor.required'    => '1',
                'data_1.*.diagnois.required'  => '1',
                'data_1.*.service.required'   => '1',
                'data_2.*.name.required'      => '1',
                'data_2.*.qtn.required'       => '1',
                'data_2.*.use.required'       => '1',
            ];
            $validator = Validator::make($data, [
                'data_1.*.patient'         => 'required',
                'data_1.*.doctor'          => 'required',
                'data_1.*.diagnois'        => 'required',
                'data_1.*.service'         => 'required',
                'data_2.*.name'            => 'required',
                'data_2.*.qtn'             => 'required',
                'data_2.*.use'             => 'required',
            ],$mess);
           
            if ($validator->fails()) {
             
                $this->respon['status'] = NG;
                $error = $validator -> errors()->toArray(); 
               
                foreach($error as $key => $vla){
                    $c = strpos( $key,".") + 3;
                    $this->respon['errors'][substr($key,$c)]=$vla[0];
                }
            }else{
                $diagnosis = $request-> diagnosis[0];
                $params['patient']       = $diagnosis['patient'];
                $params['doctor']        = $diagnosis['doctor'];
                $params['total_monney']  = $diagnosis['total_monney'];
                $params['diagnois']      = $diagnosis['diagnois'];
                $params['service']       = $diagnosis['service'];
                $params['time_re']       = $diagnosis['time_re'] ?? null;
             
                $result = DAO::executeSql('SPC_DIAGNOSIS_ACT0',$params);
    
                $pr['id']   = $result[1][0]['diagnosis_id'];
                Session::put('id',$pr['id']);
                $pr['json'] = $request -> diagnosis_detail;
                $data = DAO::executeSql('SPC_DIAGNOSIS_DETAIL_ACT1',$pr);
            
            }
          
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
    public function healthPDF(){
        $param['id'] = Session::get('id');
        $result = DAO::executeSql('SPC_DIAGNOSIS_INQ_1',$param);
        $data['data']       =  $result[0][0];
        $data['medicines']  =  $result[1];
        $pdf = PDF::loadView('ex_health.healthpdf', $data);
         return $pdf->stream('healthpdf.pdf');
    }
}
