<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTermConditionController extends Controller
{
    //
    public function manageTerms()
    {
        return view('admin.term-conditions');
    }
}