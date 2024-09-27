<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCareerPathway extends Model
{
    use HasFactory;
    protected $fillable = [
        'career_pathway_id',
        'course_id',
    ];
}
