<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {

        $rules = [
            'name' => 'required',
            'username' => ['required','unique:users'],
            'username' => 'required|string|max:255|min:4|unique:users,username,'.$this->id,
            'email' => 'required|string|email|max:255|min:4|unique:users,email,'.$this->id,
            'phone' => 'required|unique:users,email,'.$this->id, 
            'status' => 'required',
        ];

        if (!$this->has('password'))
         {
           $rules += ['password'=> 'required'|'string'| 'min:8' | 'confirmed'];
        }

        return $rules;
    }
}
