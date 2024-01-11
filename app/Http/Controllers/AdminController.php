<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $view["title"] = "Dashboard";
        $view["userName"] = auth()->user()->name;
        return view("admin.dashboard", $view);
    }
    
}