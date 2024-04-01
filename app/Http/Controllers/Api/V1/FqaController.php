<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FqaResource;
use App\Repositoryinterface\FqaRepositoryinterface;

class FqaController extends Controller
{
    private $fqaRepositry;
    public function __construct(FqaRepositoryinterface $fqaRepositry)
    {
        $this->fqaRepositry = $fqaRepositry;
    }


    public function get_fqa()
    {
        $get_fqa = $this->fqaRepositry->get_fqa();
        if( $get_fqa != null){
          return Resp( FqaResource::collection($get_fqa), 'success', 200, true);
        }else{
          return Resp('','No Fqa','404');
        }

    }


}
