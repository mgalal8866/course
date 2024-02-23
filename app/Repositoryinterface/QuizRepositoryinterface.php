<?php
namespace App\Repositoryinterface;

interface QuizRepositoryinterface{

public function get_quiz_by_category($category_id);
public function get_quiz_by_id($quiz_id);

}


