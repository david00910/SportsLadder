<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
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
            'winner_id' => $this->winners,
            'loser_id' => $this->losers,
            'result' => $this->result,
            'updated_at' => $this->updated_at,
        ];
    }
}
