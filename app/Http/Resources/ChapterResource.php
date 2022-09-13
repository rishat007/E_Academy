<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChapterResource extends JsonResource
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
            'name' => $this->name,
            'status'=>$this->status,
            $this->whenLoaded('chapters', fn()=>$this->merge([
                'class' => $this->chapters->name
            ]))
        ];
    }
}
