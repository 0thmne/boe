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
            'uuid' => (string) Str::uuid(), // Generate a unique UUID
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'site' => '', // Keep site empty
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'agent', // Set role to agent
        ]);

        return redirect()->back()->with('success', 'Agent added successfully!');
    }

    public function showEditForm($uuid)
    {
        $requestDetails = FormData::where('uuid', $uuid)->firstOrFail();
        $agents = User::where('role', 'agent')->get();

        return view('admin.edit', compact('requestDetails', 'agents'));
    }

    public function updateRequest(Request $request, $uuid)
    {
        $validatedData = $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
            'description' => 'nullable|string',
            'comments' => 'nullable|string',
            'status' => 'required|string|in:New,In Progress,Completed',
        ]);

        $requestDetails = FormData::where('uuid', $uuid)->firstOrFail();
        $requestDetails->update([
            'assigned_to' => $validatedData['assigned_to'] ?? $requestDetails->assigned_to,
            'due_date' => $validatedData['due_date'] ?? $requestDetails->due_date,
            'description' => $validatedData['description'] ?? $requestDetails->description,
            'comments' => $validatedData['comments'] ?? $requestDetails->comments,
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('admin.index')->with('success', 'Request updated successfully!');
    }
}
