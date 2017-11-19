<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseDetailList extends Model
{
    // This is Eloquent Model of course_detail_list.
    protected $table = 'course_detail_list';
    public $timestamps = false;
    protected $guarded = ['default_form'];
}
