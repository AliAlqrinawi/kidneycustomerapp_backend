<?php

namespace App\Http\Resources\Posts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'image' => imageUrl($this->image),
            'video_link' => $this->video_link,
            'title' => isset($this->translate(app()->getLocale())->title) ? $this->translate(app()->getLocale())->title : '',
            'text' => isset($this->translate(app()->getLocale())->text) ? $this->translate(app()->getLocale())->text : '',
            'created_at' => $this->created_at
        ];


        return $data;
    }
}
