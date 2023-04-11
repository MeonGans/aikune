<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Jenssegers\Date\Date;

class LessonCloseResource extends JsonResource
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
            'img_small' => 'https://api.aikune.xyz/small_black/' . $this->id . '.jpg',
            'duration' => $this->duration . 'мин',
            'opening_at' => $this->opening_at,
        ];
    }
}
