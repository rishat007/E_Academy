<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCardInfoResource extends JsonResource
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
            "card_number" => $this->card_number,
            "user_id"  => $this->user_id,
            "balance"   => $this->balance,
            "pin_no"  => $this->pin_no,
            "status"   => $this->status
        ];
    }
}
