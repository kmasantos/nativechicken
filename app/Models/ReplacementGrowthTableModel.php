<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplacementGrowthTableModel extends Model
{
    protected $table = 'replacement_growths';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
