<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;

    protected $table = 'form_data';

    protected $fillable = [
        'uuid',
        'name',
        'surname',
        'site',
        'status',
        'type',
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
        'file_client',
        'assigned_to',
        'due_date',
        'description',
        'comments',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'due_date',
        'dateech'
    ];

    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}