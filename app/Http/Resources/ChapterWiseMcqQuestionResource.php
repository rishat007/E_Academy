<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChapterWiseMcqQuestionResource extends JsonResource
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
            'chapter' => $this->name,
            $this->whenLoaded('mcq_questions', fn()=>$this->merge([
                'mcq_questions' => $this->mcq_questions->map(function($row){
                    return [
                        'question' => $row->question,
                        "answer" => $row->answer,
                        "options" => $row->options->map(fn($o)=> $o->option)
                    ];
                })
            ]))
        ];
    }
}
