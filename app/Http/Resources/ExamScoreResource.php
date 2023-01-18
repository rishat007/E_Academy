<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamScoreResource extends JsonResource
{
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'uuid' => $this->uuid,
            'subject' => $this->subject,
            'chapter' => optional($this->chapter)->name,
            'subject' => @$this->chapter->subject->name,
            'correct' => $this->exam_answer_count,
            'participate' => $this->participate
        ];
    }
}
