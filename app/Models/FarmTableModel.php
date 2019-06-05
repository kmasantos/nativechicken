<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmTableModel extends Model
{
    protected $table = 'farms';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
