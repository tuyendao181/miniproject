<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function listUser(){
        return view('system.list_user');
    }
    public function addUser(Request $request){
        try { 
            $validator = Validator::make($request->all(), [
                'name'       => 'required',
                'date_birth' => 'required|date',
                'address'    => 'required',
                'gender'     => 'required',
                'phone'      => 'required',
                'email'      => 'required',
                'password'   => 'required',
                'avatar'     => 'image|mimes:jpeg,png,jpg,gif,svg',
                'avatar'     => 'required',
            ]);
            if ($validator->fails()) {
                 $this->respon['status'] = NG;
                 $error = $validator -> errors()->toArray(); 
                 foreach($error as $key => $vla){
                     $this->respon['errors'][$key]=$vla[0];
                 }
            }
            else{
                $params['name']       = $request -> name ; 
                $params['date_birth'] = $request -> date_birth ; 
                $params['address']    = $request -> address ; 
                $params['gender']     = $request -> gender ; 
                $params['phone']      = $request -> phone ; 
                $params['email']      = $request -> email ; 
                $params['password']   = $request -> password ; 

            
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

                 // Category::add_Category($filenamemain);
                 // $list=Category::list_Category();
                 // return view('admin.category.list_category_ajax',compact('list')); 

            }
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
         return response()->json($this->respon);


    }
}
