<?php

namespace App\Rules;

use App\Models\CategoryTranslation;
use Illuminate\Contracts\Validation\Rule;

class UniqueCategoryName implements Rule
{
    private $categoryName;
    private $categoryId;

    public function __construct($categoryName,$categoryId)
    {
       $this->categoryName = $categoryName;
        $this->categoryId = $categoryId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if( $this->categoryId)
        $attribute = CategoryTranslation::where('name',  $value)->where('category_id','!=', $this->categoryId)->first();
        else
        $attribute = CategoryTranslation::where('name', $value)->first();

        if ($attribute)
            return false;
        else
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ' this name already exists  before';
    }
}
