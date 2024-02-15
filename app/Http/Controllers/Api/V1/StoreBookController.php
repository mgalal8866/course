<?php

namespace App\Http\Controllers\Api\V1;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BooksResource;
use App\Http\Resources\PaginationResource;
use App\Repositoryinterface\StoreBookRepositoryinterface;
use App\Repositoryinterface\StudyScheduleRepositoryinterface;

class StoreBookController extends Controller
{
    private $store_book;
    public function __construct(StoreBookRepositoryinterface $store_book)
    {
        $this->store_book = $store_book;
    }

    function get_books_by_category($id)
    {
        $data=  $this->store_book->get_books_by_category($id);
        //   $data= BooksResource::Collection($data);
          $data = new PaginationResource($data,BooksResource::class,'books');

          return Resp($data,'success') ;
    }
}
