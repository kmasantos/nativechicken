<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EggQualityTableModel extends Model
{
    protected $table = 'egg_qualities';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
