<?php

namespace App\Http\Controllers;
use App\Helper\DAO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    //
    public function getMess(){
        $result = DAO::executeSql('SPC_MESSAGE_LST_1');
        return response()->json(['status' => 200, 'data' => $result[0]]);
    }
}
