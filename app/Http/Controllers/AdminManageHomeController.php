<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminManageHomeController extends Controller
{
    //
    public function index()
    {
        // Logic to manage the home page settings
        return view('admin.manage-home');
    }
}
