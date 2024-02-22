<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistResource;
use App\Repositoryinterface\WishlistRepositoryinterface;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    private $wishlistRepositry;
    public function __construct(WishlistRepositoryinterface $wishlistRepositry)
    {
        $this->wishlistRepositry = $wishlistRepositry;
    }

    public function get_wishlist()
    {
        return Resp(WishlistResource::collection($this->wishlistRepositry->getwishlist()), 'success', 200, true);
    }
    public function delete_from_wishlist(Request $request)
    {
        if($request->has('book_id'))
        return Resp(WishlistResource::collection($this->wishlistRepositry->deletewishlist($request->book_id)), 'success', 200, true);
    }
    public function add_to_wishlist(Request $request)
    {
        if($request->has('book_id'))
        return Resp(WishlistResource::collection($this->wishlistRepositry->addtowishlist($request->book_id)), 'success', 200, true);
    }

}
