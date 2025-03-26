<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SauceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'manufacturer'  => $this->manufacturer,
            'description'   => $this->description,
            'mainPepper'    => $this->mainPepper,
            'heat'          => $this->heat,
            'imageUrl'      => $this->imageUrl,
            'likes'         => $this->likes,
            'dislikes'      => $this->dislikes,
            'usersLiked'    => $this->usersLiked,
            'usersDisliked' => $this->usersDisliked,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
