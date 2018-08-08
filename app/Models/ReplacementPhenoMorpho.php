<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplacementPhenoMorpho extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'replacement_pheno_morphos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    public function replacements()
    {
        return $this->belongsTo(Replacement::class);
    }

    public function replacement_pheno_morpho_values()
    {
        return $this->belongsTo(ReplacementPhenoMorphoValues::class);
    }
}
