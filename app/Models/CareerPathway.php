<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerPathway extends Model
{
    use HasFactory;

    protected $fillable = [
        'riasec_id',
        'career_name',
    ];
}
