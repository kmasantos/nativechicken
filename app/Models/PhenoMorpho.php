<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhenoMorpho extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pheno_morphos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'replacement_inventory_id', 'breeder_inventory_id', 'values_id'
    ];

    public function replacement_inventories()
    {
        return $this->belongsTo(ReplacementInventory::class);
    }

    public function breeder_inventories()
    {
        return $this->belongsTo(BreederInventory::class);
    }

    public function pheno_morpho_values()
    {
        return $this->hasMany(PhenoMorphoValue::class);
    }
}
