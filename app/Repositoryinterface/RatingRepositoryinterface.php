<?php

namespace App\Repositoryinterface;

interface RatingRepositoryinterface
{
    public function get_rating_course();
    public function get_rating_result();
    public function send_rating_result();
}
