<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChapterStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can("Create Chapter");
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
            "subjects_id"=>['required','integer']
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
