<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminManageServicesController extends Controller
{
    //
    public function index()
    {
        // Logic to manage the home page settings
        return view('admin.manage-services');
    }
}
