<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Get the selected filters from the request
        $selectedTypeFilter = $request->input('type', '');
        $selectedStatusFilter = $request->input('status', '');

        // Fetch all form data with pagination
        $formDataQuery = FormData::query();

        // Apply filters if they are set
        if ($selectedTypeFilter) {
            $formDataQuery->where('type', $selectedTypeFilter);
        }
        if ($selectedStatusFilter) {
            $formDataQuery->where('status', $selectedStatusFilter);
        }

        $formData = $formDataQuery->paginate(8);

        // Count by status
        $countNew = FormData::where('status', 'New')->count();
        $countProgress = FormData::where('status', 'In Progress')->count();
        $countCompleted = FormData::where('status', 'Completed')->count();

        // Pass the data and filters to the view
        return view('admin.index', [
            'formData' => $formData,
            'selectedTypeFilter' => $selectedTypeFilter,
            'selectedStatusFilter' => $selectedStatusFilter,
            'countNew' => $countNew,
            'countProgress' => $countProgress,
            'countCompleted' => $countCompleted,
        ]);
    }
}
