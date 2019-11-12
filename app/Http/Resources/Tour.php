<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Tour extends JsonResource
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
            'avatar' => $this->avatar,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'tour_city_new' => $this->tourCityNew,
            'tour_route' => $this->tour_route,
            'category_id' => $this->category_id,
            //'category' => $this->tourCategory,
            'people_category_id' => $this->people_category_id,
            'people_count' => $this->people_count,
            'timing_id' => $this->timing_id,
            'price' => $this->price,
            'currency_id' => $this->currency_id,
            'price_type_id' => $this->price_type_id,
            'tour_services' => $this->tour_services,
            'tour_more' => $this->tour_more,
            'tour_other' => $this->tour_other,
            'about' => $this->about,
            'active' => $this->active,
            'tour_language' => Tour::collection($this->tourLanguage)->pluck('id'),
            'tour_image' => $this->tourImage,
        ];
    }
}
