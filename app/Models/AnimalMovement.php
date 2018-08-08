<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalMovement extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'animal_movements';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'activity', 'price', 'number_male', 'number_female', 'number_total', 'remarks'  
    ];

    public function pens()
    {
        return $this->belongsTo(Pen::class);
    }

    public function families()
    {
        return $this->belongsTo(Family::class);
    }
    
}
