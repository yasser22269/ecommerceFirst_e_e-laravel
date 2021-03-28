<?php

namespace App\Http\Requests;

use App\Rules\UniqueCategoryName;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'name' => 'required|max:100',
                'slug' => 'required|unique:products,slug,'. $this->id,
                'description' => 'required|max:1000',
                'short_description' => 'nullable|max:500',
                'categories' => 'array|min:1', //[]
                'categories.*' => 'numeric|exists:categories,id',
                'tags' => 'array|min:1', //[]
                'tags.*' => 'numeric|exists:tags,id',
                'brand_id' => 'required|exists:brands,id',
                'price' => 'required|min:0|numeric',

        ];
    }
}
