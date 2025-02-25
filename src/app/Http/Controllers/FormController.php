<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;

class FormController extends Controller
{
    public function showForm()
    {
        return view('demande');
    }

    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'uuid' => 'required|string|unique:form_data,uuid', // Ensure 'uuid' is unique
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'site' => 'required|string',
            'status' => 'nullable|string|in:Nouveau,En Cours,Terminé',
            'type' => 'required|string',
            'nombreArticles' => 'nullable|integer',
            'aocType' => 'nullable|string',
            'rechercheDoc' => 'nullable|string',
            'langue' => 'nullable|string',
            'nbeNom' => 'nullable|string',
            'rechercheDocNom' => 'nullable|string',
            'langueNom' => 'nullable|string',
            'nbeNomTrait' => 'nullable|string',
            'metier' => 'nullable|string',
            'nombreLignes' => 'nullable|string',
            'metierNbe' => 'nullable|string',
            'secteur' => 'nullable|string',
            'nomProjet' => 'nullable|string',
            'typeMillion' => 'nullable|string',
            'fonctionPrincipale' => 'nullable|string',
            'fonctionElementaire' => 'nullable|string',
            'nombreLignesNbe' => 'nullable|string',
            'posteTechnique' => 'nullable|string',
            'fichier_codif' => 'nullable|file',
            'fichier_nom' => 'nullable|file',
            'fichier_nbe' => 'nullable|file',
        ]);

        // Handle file uploads
        $filePaths = [];
        if ($request->hasFile('fichier_codif')) {
            $filePaths[] = $request->file('fichier_codif')->store('uploads', 'public');
        }
        if ($request->hasFile('fichier_nom')) {
            $filePaths[] = $request->file('fichier_nom')->store('uploads', 'public');
        }
        if ($request->hasFile('fichier_nbe')) {
            $filePaths[] = $request->file('fichier_nbe')->store('uploads', 'public');
        }

        // Store file paths as a JSON array in the 'fichier_client' column
        $validatedData['fichier_client'] = json_encode($filePaths);

        FormData::create($validatedData);

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}