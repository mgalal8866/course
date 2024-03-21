<?php

namespace App\Repositoryinterface;

interface BlogRepositoryinterface
{
    public function get_blog_by_id($id);
    public function get_blog_by_category();
}
