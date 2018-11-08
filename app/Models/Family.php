<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $dates = ['deleted_at'];
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
    public function getBreeder()
    {
        $breeder = Breeder::where('family_id', $this->id)->first();
        return $breeder;
    }

    public function getReplacement()
    {
        $replacement = Replacment::where('family_id', $this->id)->first();
        return $replacement;
    }

    public function getBrooderGrower()
    {
        $broodergrower = BrooderGrower::where('family_id', $this->id)->first();
        return $broodergrower;
    }

    public function getLine()
    {
        $line = Line::where('id', $this->line_id)->first();
        return $line;
    }

    public function getGeneration()
    {
        $generation = Generation::where('id', $this->getLine()->generation_id)->first();
        return $generation;
    }
}
