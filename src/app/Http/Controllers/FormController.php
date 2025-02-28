<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        try {
            // Base validation rules that apply to all request types
            $baseRules = [
                'uuid' => 'required|string|unique:form_data,uuid|unique:users,uuid',
                'name' => 'required|string',
                'surname' => 'required|string',
                'site' => 'required|string',
                'type' => 'required|string',
            ];

            // Base validation messages
            $messages = [
                'uuid.required' => 'The ID field is required.',
                'uuid.unique' => 'This ID is already in use.',
                'name.required' => 'The name field is required.',
                'surname.required' => 'The surname field is required.',
                'site.required' => 'The site field is required.',
                'type.required' => 'Please select a request type.',
            ];

            // Add specific validation rules based on request type
            switch($request->type) {
                case 'codification':
                    $baseRules['file_codif'] = 'required|file|mimes:xlsx,xls,zip|max:10240';
                    $baseRules['numberArticles'] = 'required|integer|min:1';
                    $baseRules['aocType'] = 'required|in:aoc,aog';
                    
                    $messages['file_codif.required'] = 'Please upload a codification file.';
                    $messages['file_codif.mimes'] = 'The codification file must be an Excel or ZIP file.';
                    $messages['file_codif.max'] = 'The codification file must not exceed 10MB.';
                    $messages['numberArticles.required'] = 'Please enter the number of articles to codify.';
                    $messages['numberArticles.min'] = 'The number of articles must be at least 1.';
                    $messages['aocType.required'] = 'Please select AOC/AOG type.';
                    break;

                case 'processing':
                    $baseRules['file_nom'] = 'required|file|mimes:xlsx,xls,zip,doc,docx|max:10240';
                    $baseRules['nbeNameTrait'] = 'required|string';
                    $baseRules['job'] = 'required|in:mechanical,painting,assembly,stamping,automation';
                    $baseRules['numberLines'] = 'required';
                    
                    $messages['file_nom.required'] = 'Please upload a nomenclature file.';
                    $messages['file_nom.mimes'] = 'The nomenclature file must be an Excel, Word, or ZIP file.';
                    $messages['file_nom.max'] = 'The nomenclature file must not exceed 10MB.';
                    $messages['nbeNameTrait.required'] = 'NBE and NBE Name is required.';
                    $messages['job.required'] = 'Please select a job type.';
                    $messages['numberLines.required'] = 'Please select the number of lines.';
                    break;

                case 'nbe':
                    $baseRules['file_nbe'] = 'required|file|mimes:xlsx,xls,zip|max:10240';
                    $baseRules['jobNbe'] = 'required|string';
                    $baseRules['sector'] = 'required|string';
                    $baseRules['projectName'] = 'required|string';
                    $baseRules['typeMillion'] = 'required|in:million1,million2';
                    
                    if ($request->typeMillion === 'million1') {
                        $baseRules['mainFunction'] = 'required|string';
                        $baseRules['elementaryFunction'] = 'required|string';
                        $baseRules['numberLinesNbe'] = 'required';
                        
                        $messages['mainFunction.required'] = 'Main Function is required for 1 million type.';
                        $messages['elementaryFunction.required'] = 'Elementary Function is required for 1 million type.';
                        $messages['numberLinesNbe.required'] = 'Please select the number of lines.';
                    } elseif ($request->typeMillion === 'million2') {
                        $baseRules['technicalPost'] = 'required|string';
                        $messages['technicalPost.required'] = 'Technical Post is required for 2 million type.';
                    }
                    
                    $messages['file_nbe.required'] = 'Please upload an NBE file.';
                    $messages['file_nbe.mimes'] = 'The NBE file must be an Excel or ZIP file.';
                    $messages['file_nbe.max'] = 'The NBE file must not exceed 10MB.';
                    $messages['jobNbe.required'] = 'Job is required.';
                    $messages['sector.required'] = 'Sector is required.';
                    $messages['projectName.required'] = 'Project Name is required.';
                    $messages['typeMillion.required'] = 'Please select the million type.';
                    break;
            }

            $validatedData = $request->validate($baseRules, $messages);

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

            // Success message based on request type
            $successMessage = match($request->type) {
                'codification' => 'Your codification request has been submitted successfully! We will process your ' . $validatedData['numberArticles'] . ' articles shortly.',
                'processing' => 'Your nomenclature processing request has been submitted successfully! We will process it shortly.',
                'loading' => 'Your nomenclature loading request has been submitted successfully! We will process it shortly.',
                'sheets' => 'Your stamping sheets request has been submitted successfully! We will process it shortly.',
                'nbe' => 'Your equipment number request has been submitted successfully! We will process it shortly.',
                'documentation' => 'Your documentation loading request has been submitted successfully! We will process it shortly.',
                default => 'Your request has been submitted successfully! We will process it shortly.'
            };

            return redirect()->back()->with('success', $successMessage);
            
        } catch (\Exception $e) {
            \Log::error('Form submission error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred while submitting your request. Please try again.']);
        }
    }

    public function showDetails($uuid)
    {
        $requestDetails = FormData::where('uuid', $uuid)->firstOrFail();
        return view('admin.details', compact('requestDetails'));
    }

    public function showFollowup($uuid)
    {
        $requestDetails = FormData::where('uuid', $uuid)->firstOrFail();
        \Log::debug('Request Details:', $requestDetails->toArray());
        return view('followup', compact('requestDetails'));
    }
}