<?php

namespace App\Http\Resources;

use App\Models\McqQuestion;
use Illuminate\Http\Resources\Json\JsonResource;

class StartExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'exam_id' => $this->uuid,
            'questions' => $this->getQuestions(),
        ];
    }

    public function getQuestions()
    {
        $mcq_questions = McqQuestion::query()
            ->with(['options' => function($query){
                return $query->select('option',"mcq_question_id");
            }])
            ->where('chapters_id', $this->chapters_id)
            ->get();

        return McqQuestionResource::collection($mcq_questions);
    }
}
