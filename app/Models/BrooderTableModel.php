<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrooderTableModel extends Model
{
    protected $table = 'brooder_growers';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
