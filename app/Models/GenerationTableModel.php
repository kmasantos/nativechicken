<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenerationTableModel extends Model
{
    protected $table = 'generations';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
