<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EggProductionTableModel extends Model
{
    protected $table = 'egg_productions';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
