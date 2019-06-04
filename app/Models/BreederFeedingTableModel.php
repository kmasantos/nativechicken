<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BreederFeedingTableModel extends Model
{
    protected $table = 'breeder_feedings';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
