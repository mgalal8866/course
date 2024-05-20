<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id'                => $this->id,
            'name'              => $this->name??'',
            'image'             => $this->imageurl??'',
            'short_description' => $this->short_description??'',
            'status'            => $this->status??'1',
            'subscripe'        => $this->isEnrolledInCourse($this->id)?'true':'false',
            'status'            => $this->statu ?? '', //عدد المقاعد
            'created_at'        => $this->created_at->format('d/m/Y')
            
            //1=الدوره شغاله
            //2=نفذت المقاعده
            //3=انتهت الدورة
        ];
    }
}
