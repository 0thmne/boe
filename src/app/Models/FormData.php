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
        'assigned_to',
        'due_date',
        'description',
        'comments',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'completed_at',
        'due_date'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'completed_at' => 'datetime',
        'due_date' => 'datetime',
    ];

    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}