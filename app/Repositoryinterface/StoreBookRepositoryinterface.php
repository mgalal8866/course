<?php
namespace App\Repositoryinterface;

interface StoreBookRepositoryinterface{


    public function get_books_by_category($request);
    public function get_book_by_id();

}

