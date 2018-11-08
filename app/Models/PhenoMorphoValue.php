<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhenoMorphoValue extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pheno_morpho_values';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender', 'tag', 'phenotypic', 'morphometric', 'date_collected'
    ];

    public function pheno_morpho_values()
    {
        return $this->belongsTo(PhenoMorpho::class);
    }
}
