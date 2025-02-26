<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'email',
    ];

    public function formData()
    {
        return $this->hasMany(FormData::class, 'assigned_to');
    }
} 