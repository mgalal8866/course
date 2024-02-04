<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    protected $resourceClass;
    protected $namedata;

    public function __construct($resource, string $resourceClass,string $namedata)
    {
        parent::__construct($resource);
        $this->resourceClass = $resourceClass;
        $this->namedata =  $namedata;
    }
    public function toArray(Request $request,): array
    {
        return [
            $this->namedata => $this->resourceClass::collection($this),
            'pagination' => [
                'total'        => $this->total(),
                'count'        => $this->count(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages'  => $this->lastPage(),
                'path'         => $this->path(),
                'current_path' => $this->path() . '?page=' . $this->currentPage(),
            ],
        ];
    }
}
