<?php

namespace App\Http\Requests;

use App\Rules\UniqueCategoryName;
use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
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
            'ar.name' => 'required|max:100',
            'en.name' => 'required|max:100',
            'attribute_id' => 'required|numeric|exists:attributes,id',
            'product_id' => 'required|numeric|exists:products,id',
          //  'price' => 'min:0|numeric',

        ];
    }
}
