<?php

namespace App\Models;

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
        return $this->hasOne(Breeder::class);
    }

    public function replacements()
    {
        return $this->hasOne(Replacement::class);
    }

    public function broodersgrowers()
    {
        return $this->hasOne(BrooderGrower::class);
    }

    public function animal_movements()
    {
        return $this->hasMany(AnimalMovement::class);
    }    

    /*
    ** Model Functions
    */
    public function hasBreeders()
    {
        $breeder = Breeder::where('family_id', $this->id)->first();
        if($breeder != null){
            return true;
        }else{
            return false;
        }
    }

    public function getBreeder()
    {
        $breeder = Breeder::where('family_id', $this->id)->first();
        return $breeder;
    }
}
