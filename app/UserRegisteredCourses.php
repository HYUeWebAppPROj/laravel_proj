<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRegisteredCourses extends Model
{
    // This is Eloquent Model of user_registered_courses.
    protected $table = 'user_registered_courses';
    public $timestamps = false;
    protected $guarded = ['loginprovider'];
}
