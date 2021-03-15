<?php

namespace App\Http\Requests\front;

use Illuminate\Foundation\Http\FormRequest;

class UserContactRequest extends FormRequest
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
            'email' => 'required|email',
            'Name' => 'required',
            'phone' => 'required',
            'massage' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [

            // 'email.required' => 'يجب الدخال البريد الالكتروني ',
            // 'email.email' => 'صيغة البريد الالكتروني غير صحيحة ',
            // 'password.required' => 'يجب الدخال كلمة المرور'

            ];
    }
}
