<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminManageAboutUsController extends Controller
{
    //
    public function index()
    {
        // Logic to manage the home page settings
        return view('admin.manage-about-us');
    }

}
