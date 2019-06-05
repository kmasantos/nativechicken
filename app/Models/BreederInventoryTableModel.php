<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreederInventoryTableModel extends Model
{
    protected $table = 'breeder_inventories';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
