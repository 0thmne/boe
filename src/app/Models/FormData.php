<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;

    protected $table = 'form_data';

    protected $fillable = [
        'name',
        'surname',
        'site',
        'uuid',
        'status',
        'type',
        'file_client', 
        'numberArticles',
        'aocType',
        'documentSearch',
        'language',
        'nbeName',
        'documentSearchNom',
        'languageName',
        'nbeNameTrait',
        'job',
        'numberLines',
        'jobNbe',
        'sector',
        'projectName',
        'typeMillion',
        'mainFunction',
        'elementaryFunction',
        'numberLinesNbe',
        'technicalPost',
    ];
}