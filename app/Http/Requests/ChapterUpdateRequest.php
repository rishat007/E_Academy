<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Subject;

class ChapterUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can("Update Chapter");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                // Rule::unique('chapters', 'name')
                // ->ignore($this->route()->student_classes)
            ],
            "status" => ["required", 'boolean'],
            "subjects_id" => ['required', 'integer'],
        ];
    }

    function prepareForValidation()
    {
        $subject = Subject::whereUuid($this->subject_id)->firstOrFail();
        $this->merge([
            'subjects_id' => $subject->id,
        ]);
    }
}
