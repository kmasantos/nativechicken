<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplacementTableModel extends Model
{
    protected $table = 'replacements';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
