<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HatcheryRecordsTableModel extends Model
{
    protected $table = 'hatchery_records';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
