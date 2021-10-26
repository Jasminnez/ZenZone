<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DailyChallengeResource extends JsonResource
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
            'photo' => $this->photo,
            'description' => $this->description,
            'date' => $this->date,
            'category' => new CategoriesResource($this->category),
            'creator' => 'Rođo',
            'user_activities_count' => $this->user_activities_count,
            'user_activities' => new UserActivityCollection($this->user_activities)
        ];
    }
}
