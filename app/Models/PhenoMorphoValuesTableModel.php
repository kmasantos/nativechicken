<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhenoMorphoValuesTableModel extends Model
{
    protected $table = 'pheno_morpho_values';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
