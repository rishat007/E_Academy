<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Subject;

class AssignTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('Assign Teacher');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'teacher_id' => ['required', 'integer'],
            'class_id' => ['required', 'integer'],
            'subject_id' => ['required', 'integer'],
        ];
    }

    public function prepareForValidation()
    {
        $subject = Subject::whereUuid($this->subject_id)->firstOrFail();        
        $teacher = User::whereUuid($this->teacher_id)->firstOrFail();
        
        $this->merge([
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
        ]);
    }

    public function attributes()
    {
        return [
            'teacher_id' => 'Teacher',
            'subject_id' => 'Subject',
            'class_id' => 'Class',
        ];
    }
}
