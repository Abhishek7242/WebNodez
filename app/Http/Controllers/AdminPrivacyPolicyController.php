<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPrivacyPolicyController extends Controller
{
    //
    public function managePrivacy()
    {
        return view('admin.privacy-policy');
    }
}