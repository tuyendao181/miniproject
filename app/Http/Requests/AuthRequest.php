<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
class AuthRequest extends FormRequest
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
            'email'       => 'required',
            'password'    => 'required',
        ];
    }
    public function messages(){
        return [
            'email.required'       => '1',
            'password.required'    => '1',

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
