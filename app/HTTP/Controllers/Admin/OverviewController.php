<?php

namespace App\HTTP\Controllers\Admin;

class OverviewController extends AdminController {
    public function index() {
        return $this->view('admin/overview', ['title' => 'Overview']);
    }
}