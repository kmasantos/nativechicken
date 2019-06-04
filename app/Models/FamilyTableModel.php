<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyTableModel extends Model
{
    protected $table = 'families';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
