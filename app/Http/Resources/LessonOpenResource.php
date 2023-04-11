<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonOpenResource extends JsonResource
{
    public static $wrap = '';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title_ru,
            'description' => $this->description_ru,
            'img_small' => 'https://api.aikune.xyz/small_color/' . $this->id . '.jpg',
            'img_big' => 'https://api.aikune.xyz/big/' . $this->id . '.jpg',
            'video_url' => 'https://api.aikune.xyz/video/' . $this->video_url . '.mp4',
            'duration' => $this->duration . 'мин',
        ];
    }
}
