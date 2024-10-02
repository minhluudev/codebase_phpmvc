<?php 
namespace App\HTTP\Controllers;
use Core\Controller;

class ArticleController extends Controller{
  public function index(){
    return $this->renderView('article', [
			'title' => 'Article'
		]);
  }
}