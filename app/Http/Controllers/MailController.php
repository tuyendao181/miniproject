<?php

namespace App\Http\Controllers;
use App\Helper\DAO;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
     /*
     * function listMail -- list data
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function listMail(Request $request){
        $result = DAO::executeSql('SPC_SEND_MAIL_LST_1');
        return view('ex_health.list_re_exam',compact('result'));
       
    }
     /*
     * function sendMail -- send mail
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @author    :
     * @return    : null
     * @access    : public
     * @see       : init
     */
    
    public function sendMail(Request $request){
        try {   
            $result = DAO::executeSql('SPC_SEND_MAIL_LST_1');
            foreach($result[0] as $item){
                $data['time'] = $item['time_re'] ;
                \Mail::to($item['patient_email'])->send(new \App\Mail\SendMail($data));
            }
            DAO::executeSql('SPC_SENDMAIL_ACT1');
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
}
