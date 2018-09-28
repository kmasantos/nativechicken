<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Replacement extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'replacements';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'batching_date', 'date_added'
    ];

    public function families()
    {
        return $this->belongsTo(Family::class);
    }

    public function replacement_inventories()
    {
        return $this->hasOne(ReplacementInventory::class);
    }

    public function replacement_feedings()
    {
        return $this->hasMany(ReplacementFeeding::class);
    }

    public function replacement_pheno_morphos()
    {
        return $this->hasMany(ReplacementPhenoMorpho::class);
    }
}
