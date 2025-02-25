<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;

    protected $table = 'form_data';

    protected $fillable = [
        'nom',
        'prenom',
        'site',
        'uuid', // Include uuid in fillable properties
        'status',
        'type',
        'fichier_client', 
        'nombreArticles',
        'aocType',
        'rechercheDoc',
        'langue',
        'nbeNom',
        'rechercheDocNom',
        'langueNom',
        'nbeNomTrait',
        'metier',
        'nombreLignes',
        'metierNbe',
        'secteur',
        'nomProjet',
        'typeMillion',
        'fonctionPrincipale',
        'fonctionElementaire',
        'nombreLignesNbe',
        'posteTechnique',
    ];
}