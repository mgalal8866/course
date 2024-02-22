<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Wishlist;
use App\Models\deferred;
use App\Models\StoreBook;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositoryinterface\WishlistRepositoryinterface;

class DBWishlistRepository implements WishlistRepositoryinterface
{
    public function getwishlist()
    {
        return  Wishlist::where('user_id', Auth::guard('student')->user()->id)->with('book')->get();
    }
    public function addtowishlist($book_id)
    {
        $w =   Wishlist::updateOrCreate(['book_id' => $book_id, 'user_id' => Auth::guard('student')->user()->id], ['user_id' => Auth::guard('student')->user()->id, 'book_id' => $book_id]);
        if ($w) {
            return $this->getwishlist();
        }
    }
    public function deleteWishlist($book_id)
    {
        
        $w =   Wishlist::where('book_id', $book_id)->where('user_id', Auth::guard('student')->user()->id)->first();
        if ($w->delete() != null) {
            return   $this->getwishlist();
        } else {
            return   $this->getwishlist();
        };
    }

}
