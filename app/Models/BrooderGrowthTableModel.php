<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrooderGrowthTableModel extends Model
{
    protected $table = 'brooder_grower_growths';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
