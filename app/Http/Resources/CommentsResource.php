<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'username' => $this->user->first_name??'',
            'comment'  => $this->body??'',
            'rating'   => $this->rating??'1',
            'created_at'    => $this->created_at?->format('d/m/Y'),
        ];
    }
}
