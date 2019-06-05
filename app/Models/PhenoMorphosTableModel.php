<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhenoMorphosTableModel extends Model
{
    protected $table = 'pheno_morphos';
    protected $primaryKey ='id';
    protected $guarded = [];
    public $timestamps = false;
}
