<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStorage extends Model
{
    // This is Eloquent Model of user_storage.
    protected $table = 'user_storage';
    public $timestamps = false;
    protected $guarded = ['stor_sess'];
}
