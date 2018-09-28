<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Breeder extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'breeders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_added'
    ];
    
    public function families()
    {
        return $this->belongsTo(Family::class);
    }
    
    public function breeder_inventories()
    {
        return $this->hasOne(BreederInventory::class);
    }

    public function breeder_feedings()
    {
        return $this->hasMany(BreederFeeding::class);
    }

    public function egg_productions()
    {
        return $this->hasMany(EggProduction::class);
    }

    public function egg_qualities()
    {
        return $this->hasMany(EggQuality::class);
    }

    public function hatchery_record()
    {
        return $this->hasMany(HatcheryRecord::class);
    }
    
}
