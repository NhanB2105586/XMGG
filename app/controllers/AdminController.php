<?php

namespace App\Controllers;

use App\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $this->sendPage('/admin/adminPage');
    }
}