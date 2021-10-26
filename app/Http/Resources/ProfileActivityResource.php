<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileActivityResource extends JsonResource
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
            'activity_id' => $this->activity->id,
            'activity_name' => $this->activity->name,
            'category' => new CategoriesResource($this->activity->category),
            'photo' => $this->photo,
            'description' => $this->description,
            'date' => $this->created_at,
            'likes' => $this->likes->count(),
            'comments' => $this->comments->count(),
        ];
    }
}
