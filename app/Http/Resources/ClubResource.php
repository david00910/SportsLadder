<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClubResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'name' => $this->name,
            'address_id' => $this->clubAddress,
            'about' => $this->about,
            'foundation_date' => $this->foundation_date,
            'owner' => $this->ownerUser,
            'created_at' => $this->created_at->toDateTimeString(),
            'avatar_url' => $this->avatar_url
        ];
    }
}
