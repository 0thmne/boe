<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all form data
        $formData = FormData::all();

        // Pass the data to the view
        return view('admin.index', ['formData' => $formData]);
    }
}
