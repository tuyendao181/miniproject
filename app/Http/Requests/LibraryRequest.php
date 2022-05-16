<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
class LibraryRequest extends FormRequest
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
            'section'  => 'required',
            'id'       => 'required|Integer',
            'value'    => 'required',
        ];
    }
    public function messages(){
        return [
            'id.required'       => '1',
            'section.required'  => '1',
            'value.required'    => '1',
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