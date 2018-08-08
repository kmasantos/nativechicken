<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'families';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'is_active'
    ];

    public function lines()
    {
        return $this->belongsTo(Generation::class);
    }

    public function breeders()
    {
        return $this->hasMany(Breeder::class);
    }

    public function replacements()
    {
        return $this->hasMany(Replacement::class);
    }

    public function broodersgrowers()
    {
        return $this->hasMany(BrooderGrower::class);
    }

    public function animal_movements()
    {
        return $this->hasMany(AnimalMovement::class);
    }    

}
