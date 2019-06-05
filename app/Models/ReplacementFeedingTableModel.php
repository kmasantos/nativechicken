<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplacementFeedingTableModel extends Model
{
    protected $table = 'replacement_feedings';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
