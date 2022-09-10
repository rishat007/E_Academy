<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'is_delete_able' => $this->created_by ? true : false,
            $this->whenLoaded('permissions', fn()=>$this->merge([
                'permissions' => $this->permissions->pluck('name')
            ]))
        ];
    }
}
