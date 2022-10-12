<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can("Create Subject");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name'=>['required','string'],
            "status"=>["required",],
            "student_class_id"=>['required','integer']
        ];
    }

    public function messages()
    {
        return[
            'student_class_id.required' => __("The class id field is required."),
        ];
    }
}
