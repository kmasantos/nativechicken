<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Breeder extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $dates = ['deleted_at'];
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

    public function getFamily()
    {
        $family = Family::where('id', $this->family_id)->first();
        return $family;
    }

    public function getLine()
    {
        $line = Line::where('id', $this->getFamily()->line_id)->first();
        return $line;
    }

    public function getGeneration()
    {
        $generation = Generation::where('id', $this->getLine()->generation_id)->first();
        return $generation;
    }
}
