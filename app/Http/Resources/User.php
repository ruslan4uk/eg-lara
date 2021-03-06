<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'user_service' => User::collection($this->userService)->pluck('id'),
            'user_language' => User::collection($this->userLanguage)->pluck('id'),
            'user_contact' => $this->userContact,
            'user_license' => $this->userLicense,
            'user_city' => $this->userCity,
            'user_city_ids'  => User::collection($this->userCity)->pluck('id'),
            'user_favorite_guide' => $this->userFavoriteGuide,
            'unreadMessage' => $this->unreadMessage(),
        ];
    }
}
