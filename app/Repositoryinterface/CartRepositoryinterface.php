<?php
namespace App\Repositoryinterface;

interface CartRepositoryinterface{
    public function getcart();
    public function addtocart($book_id, $qty);
    public function deletecart($book_id);
}

