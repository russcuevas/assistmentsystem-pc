<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'course_description',
        'course_picture',
    ];

    public function setCoursePicturesAttribute($value)
    {
        $this->attributes['course_picture'] = json_encode($value);
    }

    public function getCoursePicturesAttribute($value)
    {
        return json_decode($value, true);
    }
}
