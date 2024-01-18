<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class putResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'result_id' => $this->result_id,
            'polling_unit_uniqueid' => $this->polling_unit_uniqueid,
            'party_abbreviation' => $this->party_abbreviation,
            'result_id' => $this->result_id,
            'party_score'=>$this->party_score
            ];
    }
}
