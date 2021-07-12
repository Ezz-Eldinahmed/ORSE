<?php

namespace App\Http\Requests;

use App\Rules\categoryInstructorOverlap;
use Illuminate\Foundation\Http\FormRequest;

class InstructorRequest extends FormRequest
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
            'resume' => 'required|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:2048',
            'certification' => 'required|max:500',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
