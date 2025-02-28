<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Str;
use Carbon\Carbon;

class AgentController extends Controller
{
    public function index()
    {
        // For testing, let's get the first agent from the database
        $agent = User::where('role', 'agent')->first();
        if (!$agent) {
            // Create a test agent if none exists
            $agent = User::create([
                'uuid' => Str::uuid(),
                'name' => 'Test Agent',
                'surname' => 'Demo',
                'site' => 'Test Site',
                'email' => 'othmane.ait-salah@capgemini.com',
                'password' => bcrypt('asasas'),
                'role' => 'agent'
            ]);
        }
        
        // Fetch requests assigned to this agent with all necessary fields
        $requests = FormData::with('assignedAgent')
            ->select([
                'uuid',
                'name',
                'surname',
                'site',
                'status',
                'type',
                'file_client',
                'assigned_to',
                'due_date',
                'description',
                'comments',
                'created_at',
                'updated_at'
            ])
            ->where('assigned_to', $agent->id)
            ->whereIn('status', ['New', 'In Progress'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Format the data for the view
        $formattedRequests = $requests->map(function ($request) {
            return [
                'uuid' => $request->uuid,
                'name' => $request->name . ' ' . $request->surname,
                'site' => $request->site,
                'status' => $request->status,
                'type' => $request->type,
                'created_at' => Carbon::parse($request->created_at)->format('d/m/Y'),
                'due_date' => $request->due_date ? Carbon::parse($request->due_date)->format('d/m/Y') : 'Not set',
                'description' => $request->description,
                'comments' => $request->comments,
                'files' => json_decode($request->file_client, true) ?? [],
                'assigned_agent' => optional($request->assignedAgent)->name
            ];
        });

        return view('agent.index', [
            'requests' => $formattedRequests,
            'agent' => $agent
        ]);
    }

    public function markAsCompleted($uuid)
    {
        $request = FormData::where('uuid', $uuid)
            ->where('assigned_to', Auth::id())
            ->firstOrFail();

        $request->status = 'Completed';
        $request->completed_at = now();
        $request->save();

        return response()->json([
            'success' => true,
            'message' => 'Request marked as completed successfully'
        ]);
    }

    public function updateRequest(Request $request, $uuid)
    {
        $validatedData = $request->validate([
            'comment' => 'nullable|string',
            'status' => 'required|string|in:New,In Progress,Completed',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png'
        ]);

        $formData = FormData::where('uuid', $uuid)
            ->where('assigned_to', Auth::id())
            ->firstOrFail();

        // Update the request status
        $formData->status = $validatedData['status'];
        if ($validatedData['status'] === 'Completed') {
            $formData->due_date = now();
        }

        // Add comment if provided
        if (!empty($validatedData['comment'])) {
            $currentTime = now()->format('Y-m-d H:i:s');
            $newComment = "$currentTime - " . Auth::user()->name . ": " . $validatedData['comment'];
            $formData->comments = $formData->comments 
                ? $formData->comments . "\n" . $newComment 
                : $newComment;
        }

        // Handle file uploads
        if ($request->hasFile('files')) {
            $uploadedFiles = [];
            $existingFiles = json_decode($formData->file_client, true) ?? [];

            foreach ($request->file('files') as $file) {
                $path = $file->store('uploads', 'public');
                $uploadedFiles[] = $path;
            }

            $formData->file_client = json_encode(array_merge($existingFiles, $uploadedFiles));
        }

        $formData->save();

        // Redirect to /agent/requests with a success message
        return redirect()->route('agent.requests')->with('success', __('app.request_updated_successfully'));
    }

    public function show($uuid)
    {
        $request = FormData::where('uuid', $uuid)->firstOrFail();
        return view('agent.details', [
            'requestDetails' => $request,
            'agent' => Auth::user()
        ]);
    }
} 