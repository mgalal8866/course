<?php

namespace App\Repository;


use App\Models\ContentUs;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\ContentUsRepositoryinterface;

class DBContentUsRepository  implements ContentUsRepositoryinterface
{
    protected Model $model;
    protected  $request;
    public function __construct(ContentUs $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function send_contentus()
    {
        $name = $this->request->input('name', null);
        $mail = $this->request->input('mail', null);
        $phone = $this->request->input('phone', null);
        $body = $this->request->input('body', null);
        $type = $this->request->input('type', null);
        
        $contentus = $this->model->create([
            'name' => $name,
            'mail' => $mail,
            'phone'=> $phone,
            'body' => $body,
            'type' => $type
        ]);
        return  $contentus;
    }
}
