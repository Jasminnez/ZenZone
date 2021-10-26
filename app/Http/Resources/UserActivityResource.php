<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserActivityResource extends JsonResource
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
          'user_id' => $this->user->id,
          'user_name' => $this->user->name,
          'user_photo' => $this->user->profile_photo_url, 
          'activity_id' => $this->activity->id,
          'activity_name' => $this->activity->name,
          'category' => new CategoriesResource($this->activity->category),
          'photo' => $this->photo,
          'is_default_photo' => $this->is_default_photo,
          'description' => $this->description,
          'date' => $this->created_at,
          'likes' => $this->likes->count(),
          'liked' => $this->like,
          'comments_count' => $this->comments->count(),
          'comments' => new CommentCollection($this->comments)
        ];
    }
}
