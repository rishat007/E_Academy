<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassWiseSubjectResource extends JsonResource
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
            'class' => $this->name,
            $this->whenLoaded('subjects', fn()=>$this->merge([
                'subjects' => $this->subjects->pluck('name','uuid')
            ]))
        ];
    }
}
