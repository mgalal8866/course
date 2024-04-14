<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use App\Http\Resources\LoginUserResource;
use App\Repositoryinterface\CollectPointsRepositoryinterface;
use Illuminate\Support\Facades\Cache;

use Illuminate\Database\Eloquent\Model;



class CollectPointsController extends Controller
{
    private $Collectpoints;
    public function __construct(CollectPointsRepositoryinterface $Collectpoints)
    {
        $this->Collectpoints = $Collectpoints;
    }

    public function convert_points()
    {
        return Resp(new LoginUserResource($this->Collectpoints->convert_points()), 'success');
    }
    public function collect_points($user_id ,$collect_user_id,$point)
    {
        //

        // return Resp(AboutUsResource::collection($aboutus ), 'success');
    }


}
