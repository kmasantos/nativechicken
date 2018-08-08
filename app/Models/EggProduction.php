<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EggProduction extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'egg_productions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_collected', 'total_eggs_intact', 'total_egg_weight', 'total_broken', 
        'total_rejects', 'remarks'
    ];

    public function breeders()
    {
        return $this->belongsTo(Breeder::class);
    }

}
