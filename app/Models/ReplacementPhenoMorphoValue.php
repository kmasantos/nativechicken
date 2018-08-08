<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplacementPhenoMorphoValue extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'replacement_pheno_morpho_values';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender', 'phenotypic', 'morphometric', 'date_collected'
    ];

    public function replacement_pheno_morpho()
    {
        return $this->hasMany(ReplacementPhenoMorpho::class);
    }
}
