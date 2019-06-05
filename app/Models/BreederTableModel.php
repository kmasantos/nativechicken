<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreederTableModel extends Model
{
    protected $table = 'breeders';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
