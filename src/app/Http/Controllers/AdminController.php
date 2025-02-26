<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;
use App\Models\User;
use Illuminate\Support\Str;

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

    public function showAddAgentForm()
    {
        return view('admin.add-agent');
    }

    public function storeAgent(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        User::create([
            'uuid' => '', // Set uuid to an empty string
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'site' => '', // Keep site empty
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'agent', // Set role to agent
        ]);

        return redirect()->back()->with('success', 'Agent added successfully!');
    }
}
