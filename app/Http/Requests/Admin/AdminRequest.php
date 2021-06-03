<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
    public static function login()
    {
        return [
            'email' =>  'required',
            'password' =>  'required',
        ];
    }

    public static function change_password(){
        return [
            'current_password' => 'required',
            'new_password'=> 'required|different:current_password|min:6',
            'confirm_password'=> 'required|same:new_password|min:6',
        ];
    }

    public static function user_reset_password(){
        return [
            'new_password'=> 'required|min:6',
            'confirm_password'=> 'required|same:new_password|min:6',
        ];
    }
}
