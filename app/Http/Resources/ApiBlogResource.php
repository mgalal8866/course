<?php

namespace App\Http\Resources;

use App\Models\AboutUs;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiBlogResource extends JsonResource
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
            'body'    => $this->article ?? '',
            'tags'    => $this->tags ?? '',
            'author_name'   => $this->author_name ?? '',
            'author_image'  => $this->author_image ?? '',
            'created_at'    => $this->created_at->format('d/m/Y') ?? ''

        ];
    }
}
