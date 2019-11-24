<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Search extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'city_id' => $this->id,
            'city_name' => $this->name,
            'city_region' => $this->region,
            'country_id' => $this->cityCountryNew->id,
            'country_name' => $this->cityCountryNew->name,
            'country_iso' => $this->cityCountryNew->iso_code
        ];
    }
}
