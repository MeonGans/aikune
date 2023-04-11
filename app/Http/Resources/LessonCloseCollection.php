<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Jenssegers\Date\Date;

class LessonCloseCollection extends ResourceCollection
{
    public static $wrap = '';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $id_first = $this->collection->first()->id ?? null;
        if($id_first !== null){
            return $this->collection->map(function ($item) use ($id_first){
                $add_days = 1 + $item->id - $id_first;
                $item->opening_at = Date::now()->add($add_days . ' day')->format('d.m');
                return $item;
            });
        } else {
            return [];
        }
    }
}
