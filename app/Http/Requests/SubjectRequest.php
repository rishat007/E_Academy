<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can("Update Subject");
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
                // Rule::unique('subjects', 'name')
                // ->ignore($this->route()->subject)
            ],
            "status" => ["required", 'boolean'],
            "student_class_id" => ['required', 'integer'],
        ];
    }
}
