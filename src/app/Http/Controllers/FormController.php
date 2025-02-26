<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;
use App\Models\User;

class FormController extends Controller
{
    public function showForm()
    {
        return view('demande');
    }

    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'uuid' => 'required|string|unique:form_data,uuid|unique:users,uuid',
            'name' => 'required|string',
            'surname' => 'required|string',
            'site' => 'required|string',
            'status' => 'nullable|string|in:New,In Progress,Completed',
            'type' => 'required|string',
            'numberArticles' => 'nullable|integer',
            'aocType' => 'nullable|string',
            'documentSearch' => 'nullable|string',
            'language' => 'nullable|string',
            'nbeName' => 'nullable|string',
            'documentSearchNom' => 'nullable|string',
            'languageName' => 'nullable|string',
            'nbeNameTrait' => 'nullable|string',
            'job' => 'nullable|string',
            'numberLines' => 'nullable|string',
            'jobNbe' => 'nullable|string',
            'sector' => 'nullable|string',
            'projectName' => 'nullable|string',
            'typeMillion' => 'nullable|string',
            'mainFunction' => 'nullable|string',
            'elementaryFunction' => 'nullable|string',
            'numberLinesNbe' => 'nullable|string',
            'technicalPost' => 'nullable|string',
            'file_codif' => 'nullable|file',
            'file_nom' => 'nullable|file',
            'file_nbe' => 'nullable|file',
        ]);

        // Handle file uploads
        $filePaths = [];
        if ($request->hasFile('file_codif')) {
            $filePaths[] = $request->file('file_codif')->storeAs('uploads', $request->file('file_codif')->getClientOriginalName(), 'public');
        }
        if ($request->hasFile('file_nom')) {
            $filePaths[] = $request->file('file_nom')->storeAs('uploads', $request->file('file_nom')->getClientOriginalName(), 'public');
        }
        if ($request->hasFile('file_nbe')) {
            $filePaths[] = $request->file('file_nbe')->storeAs('uploads', $request->file('file_nbe')->getClientOriginalName(), 'public');
        }

        // Store file paths as a JSON array in the 'file_client' column
        $validatedData['file_client'] = json_encode($filePaths);

        // Save data in form_data table
        FormData::create($validatedData);

        // Save data in users table
        User::create([
            'uuid' => $validatedData['uuid'],
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'site' => $validatedData['site'],
            'email' => $validatedData['surname'] . '@client.com', 
            'password' => bcrypt('password'), 
            'role' => 'client', 
        ]);

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }

    public function showDetails($uuid)
    {
        $requestDetails = FormData::where('uuid', $uuid)->firstOrFail();
        return view('admin.details', compact('requestDetails'));
    }
}