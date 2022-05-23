<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
class DoctorRequest extends FormRequest
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
            'name'          => 'required',
            'date_birth'    => 'required|date',
            'address'       => 'required',
            'gender'        => 'required|integer',
            'phone'         => 'required|max:20',
            'email'         => 'required|email',
        ];
    }
    public function messages(){
        return [
            'name.required'          => '1',
            'date_birth.required'    => '1',
            'date_birth.date'        => '3',
            'address.required'       => '1',
            'gender.required'        => '1',
            'gender.integer'         => '3',
            'phone.required'         => '1',
            'phone.max'              => '3',
            'email.required'         => '1',
            'email.email'            => '3',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $respon['status'] = NG;
        $respon['errors'] = (new ValidationException($validator))->errors();
        foreach($respon['errors'] as $key => $vla){
            // $mess[$key]=$vla[0];
            $respon['errors'][$key]=$vla[0];
        }
        // $respon['errors']=$mess;
        throw new HttpResponseException(
            response()->json($respon,200)
        );
    }
}
