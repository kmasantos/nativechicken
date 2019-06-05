<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineTableModel extends Model
{
    protected $table = 'lines';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
