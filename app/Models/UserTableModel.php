<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTableModel extends Model
{
    protected $table = 'users';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
