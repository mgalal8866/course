<?php

namespace App\Repository;

use App\Models\StoreBook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Repositoryinterface\StoreBookRepositoryinterface;

class DBStoreBookRepository implements StoreBookRepositoryinterface
{

    protected Model $model;
    protected $request;


    public function __construct(StoreBook $model,Request $request)
    {
        $this->request = $request;
        $this->model = $model;
    }

    public function get_books_by_category($id)
    {
        $perPage = $this->request->input('per_page', 20);
        return $this->model->whereCategoryId($id)->paginate($perPage);
    }
    public function get_book_by_id()
    {
        $book_id = $this->request->input('book_id');
        
        return $this->model->find($book_id);
    }
    public function buy_book($id)
    {
        $perPage = $this->request->input('per_page', 20);
        return $this->model->whereCategoryId($id)->paginate($perPage);
    }
}
