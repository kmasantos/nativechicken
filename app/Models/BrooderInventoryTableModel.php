<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrooderInventoryTableModel extends Model
{
    protected $table = 'brooder_grower_inventories';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
