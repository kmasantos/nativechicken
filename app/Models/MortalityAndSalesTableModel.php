<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MortalityAndSalesTableModel extends Model
{
    protected $table = 'mortality_sales';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
