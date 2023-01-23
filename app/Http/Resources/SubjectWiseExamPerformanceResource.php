<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectWiseExamPerformanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "uuid" => $this->uuid,
            "name" => $this->name,
            "exams" => $this->exams->map(function($row){
                return [
                    "uuid" => $row->uuid,
                    "score" => $row->score,
                    "participate" => $row->participate,
                    "date" => $row->created_at,
                    'chapter' => @$row->chapter->name
                ];
            }),
            
        ];
    }
}
