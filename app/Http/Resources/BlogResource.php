<?php

namespace App\Http\Resources;

use App\Models\AboutUs;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id??'',
            'image'   => $this->imageurl??'',
            'title'   => $this->title??'',
            'body'    => Str::of(strip_tags( $this->article))->limit(20) ?? ''

        ];
    }
}
