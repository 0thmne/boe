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
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'site' => 'required|string',
            'id' => 'required|string',
            'type' => 'required|string',
            'fichier' => 'nullable|file',
            'nombreArticles' => 'nullable|integer',
            'aocType' => 'nullable|string',
            'rechercheDoc' => 'nullable|string',
            'langue' => 'nullable|string',
            'nbeNom' => 'nullable|string',
            'fichierNom' => 'nullable|file',
            'rechercheDocNom' => 'nullable|string',
            'langueNom' => 'nullable|string',
            'nbeNomTrait' => 'nullable|string',
            'metier' => 'nullable|string',
            'nombreLignes' => 'nullable|string',
            'fichierNbe' => 'nullable|file',
            'metierNbe' => 'nullable|string',
            'secteur' => 'nullable|string',
            'nomProjet' => 'nullable|string',
            'typeMillion' => 'nullable|string',
            'fonctionPrincipale' => 'nullable|string',
            'fonctionElementaire' => 'nullable|string',
            'nombreLignesNbe' => 'nullable|string',
            'posteTechnique' => 'nullable|string',
        ]);

        // Handle file uploads
        if ($request->hasFile('fichier')) {
            $validatedData['fichier'] = $request->file('fichier')->store('uploads', 'public');
        }
        if ($request->hasFile('fichierNom')) {
            $validatedData['fichierNom'] = $request->file('fichierNom')->store('uploads', 'public');
        }
        if ($request->hasFile('fichierNbe')) {
            $validatedData['fichierNbe'] = $request->file('fichierNbe')->store('uploads', 'public');
        }

        FormData::create($validatedData);

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
