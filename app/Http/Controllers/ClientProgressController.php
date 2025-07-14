<?php

namespace App\Http\Controllers;

use App\Models\ClientProject;
use Illuminate\Http\Request;

class ClientProgressController extends Controller
{
    public function show($uuid)
    {
        try {
            $project = ClientProject::where('uuid', $uuid)->first();

            if (!$project) {
                return view('frontend.client-progress', ['project' => null]);
            }

            return view('frontend.client-progress', compact('project'));
        } catch (\Exception $e) {
            return view('frontend.client-progress', ['project' => null]);
        }
    }
}
