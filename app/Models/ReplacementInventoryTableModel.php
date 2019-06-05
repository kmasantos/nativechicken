<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplacementInventoryTableModel extends Model
{
    protected $table = 'replacement_inventories';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
