<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    // This is Eloquent Model of userlist.
    protected $table = 'userlist';
    public $timestamps = false;
    protected $guarded = ['storage_session_id'];
}
