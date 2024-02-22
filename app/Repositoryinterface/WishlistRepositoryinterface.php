<?php
namespace App\Repositoryinterface;

interface WishlistRepositoryinterface{
    public function getwishlist();
    public function addtowishlist($book_id);
    public function deletewishlist($book_id);
}

