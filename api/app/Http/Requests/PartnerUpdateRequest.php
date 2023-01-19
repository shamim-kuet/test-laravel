<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'legal_name' => 'required',
            'c_p_name' => 'required',
            'c_p_phone' => 'required',
            'c_p_email' => 'required',
            'hash_key' => 'required',
            'subscription_type' => 'required',
            'subscription_expiry' => 'required',
            'status' => 'required',
        ];
    }
}
