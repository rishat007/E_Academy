<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectWiseChapterResource extends JsonResource
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
            'subject' => $this->name,
            $this->whenLoaded('chapters', fn()=>$this->merge([
                // 'chapters' => $this->chapters->pluck('name','uuid')
                'chapters' =>$this->chapters->map->only(['name','uuid'])
            ]))
        ];
    }
}
