<?php

namespace App\Http\Requests;

use App\Rules\UniqueCategoryName;
use Illuminate\Foundation\Http\FormRequest;

class SliderImagesRequest extends FormRequest
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
            'ar.title' => 'required|max:100',
            'en.title' => 'required|max:100',
            'category_id' => 'required|numeric|exists:categories,id',
            'photo' => 'required_without:id|image',
            'Discount' => 'required|min:0|numeric',

        ];
    }
}
