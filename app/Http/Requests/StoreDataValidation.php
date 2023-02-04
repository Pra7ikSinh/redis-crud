<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataValidation extends FormRequest
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
            // rules
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'contact_number' => 'required|min:10|max:10',
            'email' => 'required|email|regex:/^(?=[^@]*[A-Za-z])([a-zA-Z0-9])(([a-zA-Z0-9])*([\._-])?([a-zA-Z0-9]))*@(([a-zA-Z0-9\-])+(\.))+([a-zA-Z]{2,4})+$/',
            'profile_photo' => 'required_if:id_for_update,==,null|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'required',
            'languages' => 'required',
            'designation'=>'required|regex:/^\s*[a-zA-Z.\s]+\s*$/',
            'company'=>'required|regex:/^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/',
            'assigned_team'=>'required|min:3|max:20',

        ];
    }
}
