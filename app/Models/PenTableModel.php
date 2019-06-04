<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenTableModel extends Model
{
    protected $table = 'pens';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
