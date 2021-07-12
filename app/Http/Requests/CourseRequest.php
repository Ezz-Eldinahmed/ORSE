<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'name' => 'required|max:100',
            'description' => 'required|max:300',
            'presentation' => 'required|in:Slides,FreeHand,Talking',
            'speed' => 'required|in:Slow,Normal,Fast',
            'price' => 'required|integer|max:1000',
            'assignments' => 'nullable|in:on,off',
            // 'category_id' => 'required|exists:categories,id'
        ];
    }
}
