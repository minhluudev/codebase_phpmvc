<?php

namespace App\HTTP\Controllers\Web;

use App\Models\Category;
use App\Models\User;
use Framework\Controller;

class HomeController extends Controller {
    public function index() {
        //full_name', 'email', 'password
        $user = ['full_name' => 'John Doe', 'email' => 'jon.doe3@gmail.com', 'password' => '123456'];
        echo '<pre>';
        //        var_dump(User::create($user));
        $users      = User::select(['email'])
                          ->where('email', '=', 'jon.doe3@gmail.com')
                          ->orWhere('full_name', '=', 'John Doe 2')
                          ->orderByAsc('id')
                          ->pagination(1,2);
        $categories = Category::all()
                              ->get();
        print_r($users);
        print_r($categories);
        //        $user = new User();
        //        $user->all();
        echo '</pre>';

        return $this->view('home', ['title' => 'Home title']);
    }

    public function about() {
        return $this->view('about', ['title' => 'About title']);
    }
}