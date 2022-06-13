<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'name'       => 'required',
            'date_birth' => 'required|date',
            'address'    => 'required',
            'gender'     => 'required',
            'phone'      => 'required',
            'address'      => 'required',
            'email'      => 'required',
            'password'   => 'required',
            'avatar'     => 'image|mimes:jpeg,png,jpg,gif,svg',
            'avatar'     => 'required',
        ];
    }
    public function messages(){
        return [
            'name.required'         => '1',
            'date_birth.required'   => '1',
            'date_birth.date'       => '3',
            'address.required'      => '1',
            'gender.required'       => '1',
            'phone.required'        => '1',
            'email.required'        => '1',
            'password.required'     => '1',
            'avatar.required'       => '1',
            'avatar.image'          => '3',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $respon['status'] = NG;
        $respon['errors'] = [];
        $error = (new ValidationException($validator))->errors();
        foreach($error as $key => $item){
            $temp = [
                'item'       => $key,
                'message_no' => $item[0],// key one mess
                'error_typ'  => 1,
                'value1'     => ''  //position row
            ];
            array_push($respon['errors'], $temp);  
        }
        throw new HttpResponseException(
            response()->json($respon,200)
        );
    }
}
