<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lines';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'is_active'
    ];

    public function generations()
    {
        return $this->belongsTo(Generation::class);
    }

    public function families()
    {
        return $this->hasMany(Family::class);
    }
}
