<?php

namespace App\HTTP\Controllers\Admin;

class OverviewController extends AdminController
{
    public function index()
    {
        return $this->renderView('admin/overview', ['title' => 'Overview']);
    }
}