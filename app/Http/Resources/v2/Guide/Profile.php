<?php

namespace App\Http\Resources\v2\Guide;

use App\Http\Resources\Search;
use Illuminate\Http\Resources\Json\JsonResource;

class Profile extends JsonResource
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
            'email' => $this->email,
            'about' => $this->about,
            'role' => $this->role,
            'avatar' => $this->avatar,
            'active' => $this->active,
            'status' => $this->status,
            'verify' => $this->email_verified_at ? true : false,
            'user_service' => $this::collection($this->userService)->pluck('id'),
            'user_language' => $this::collection($this->userLanguage)->pluck('id'),
            'user_contact' => $this->userContact,
            'user_license' => $this->userLicense,
            'user_city' => $this->userCity,
            'user_city2' => Search::collection($this->userCity),
            'user_city_ids'  => $this::collection($this->userCity)->pluck('id'),
            'user_favorite_guide' => $this->userFavoriteGuide,
            'unreadMessage' => $this->unreadMessage(),
        ];
    }
}
