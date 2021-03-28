<?php

namespace App\Http\Requests\front;

use App\Rules\UniqueCategoryName;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
          // |unique:brand_translations,name,' . $this->id
          'user_id' => 'required|exists:users,id',
          'f_name' => 'required',
          'e_name' => 'nullable',
          'email' => 'required|email',
          'phone' => 'required',//max:11|min:11
          'address' => 'required|max:500',
          'Country_id' => 'numeric', //|exists:categories,id
          'city' => 'required',
          'zip_code' => 'required|numeric',
          'discount' => 'nullable',
          'discount_code' => 'nullable',
          'subtotal' => 'required|numeric|min:20',
          'tax' => 'required|numeric',
          'total' => 'required|numeric|min:20',
          'payment-method' => 'required',
            //payment_gateway
        ];
    }
}
