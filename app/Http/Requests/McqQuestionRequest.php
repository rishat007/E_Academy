<?php

namespace App\Http\Requests;

use App\Models\Chapter;
use Illuminate\Foundation\Http\FormRequest;

class McqQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can("Create mcq_Questions");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question'=>['required','string'],
            'answer'=>['required','string'],
            "set"=>["required",],
            "chapters_id"=>['required','integer'],
            "options"=>['required','array'],
        ];
    }
    public function prepareForValidation(){
        $chapter = Chapter::whereUuid($this->chapters_id)->firstOrFail();
        $this->merge(['chapters_id' => $chapter->id]);
    }
}
