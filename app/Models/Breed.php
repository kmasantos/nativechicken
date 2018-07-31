<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'breeds';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'breed'
    ];

    public function farms()
    {
        return $this->belongsToMany(Farm::class);
    }

    public function animaltype()
    {
        return $this->hasOne(AnimalType::class);
    }
    
}
