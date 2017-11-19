<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseStorage extends Model
{
    // This is Eloquent Model of course_storage.
    protected $table = 'course_storage';
    public $timestamps = false;
    protected $guarded = ['stor_sess'];
}
