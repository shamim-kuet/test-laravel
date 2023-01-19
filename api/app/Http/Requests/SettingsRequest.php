<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
        return [
            'site_name' => 'required',
            'site_title' => 'required',
            'copyright_message' => 'required',
            'copyright_name' => 'required',
            'copyright_url' => 'required',
            'design_develop_by_text' => 'required',
            'design_develop_by_name' => 'required',
            'design_develop_by_url' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ];
    }
}
