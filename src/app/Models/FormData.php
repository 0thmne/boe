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
        'id',
        'type',
        'fichier',
        'nombreArticles',
        'aocType',
        'rechercheDoc',
        'langue',
        'nbeNom',
        'fichierNom',
        'rechercheDocNom',
        'langueNom',
        'nbeNomTrait',
        'metier',
        'nombreLignes',
        'fichierNbe',
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