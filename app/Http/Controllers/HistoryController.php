<?php

namespace App\Http\Controllers;
use App\Helper\DAO;
use Illuminate\Http\Request;
use session;
class HistoryController extends Controller
{
    // public function getHistory(){
    //     return view('ex_health.history');
    // }

    public function getHistory(Request $request){
        $user = Session::get('user');
        $data['user_id']= $user['user_id'];
        $data['gender'] = DAO::executeSql('SPC_LIBRARY_INQ_2');
        $data = array_merge($this->paginateHistory($request),$data);
        return view('ex_health.history',compact('data'));
    }

    //paginate
    public function paginateHistory(Request $request){
        if(empty($request->keyword)){
            $params['keyword'] = '';
        }
        else{
            $params['keyword'] = $request->keyword;
        }
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
      

        $result = DAO::executeSql('SPC_HISTORY_FND1',$params);
        $data['data']=$result[0];
        $data['paginate'] = $result[1][0];
        $data['gender'] = DAO::executeSql('SPC_LIBRARY_INQ_2');
        if($request->ajax()){
            return view('ex_health.history_ajax',compact('data'));
        }else{
            return  $data;
        }  
    }

     // refer data edit 
     public function detailHistory(Request $request ){
        try{  
            $param = $request->id;
            $result = DAO::executeSql('SPC_DIAGNOSIS_INQ_1',$param);
            $this->respon['data'] = $result[0][0];
            $this->respon['medicines'] = $result[1];
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
}
