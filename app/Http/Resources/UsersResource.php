<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
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
            'gender' => $this->gender,
            'phone' => $this->phone,
            'profile_photo_url' => $this->profile_photo_url,
            'activities_count' => $this->user_activities_count,
            'comments_count' => $this->comments_count,
            'likes_count' => $this->likes_count,
            'activities' => new ProfileActivityCollection($this->user_activities),
        ];
    }
}
