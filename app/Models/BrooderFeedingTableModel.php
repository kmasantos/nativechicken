<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrooderFeedingTableModel extends Model
{
    protected $table = 'brooder_grower_feedings';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
