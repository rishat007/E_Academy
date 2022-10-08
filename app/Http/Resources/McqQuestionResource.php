<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class McqQuestionResource extends JsonResource
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
            "uuid" => $this->uuid,
            'question' => $this->question,
            'answer' => $this->answer,
            'set'=>$this->set,

            $this->whenLoaded('chapter', fn()=>$this->merge([
                'chapter_name' => $this->chapter->name
            ])),

            $this->whenLoaded('options', fn()=>$this->merge([
                'options' => $this->options->map(fn($row)=>$row->option)
            ])),
        ];
    }
}

