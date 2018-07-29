<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'farms';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'address', 'batching_week'
    ];
    
    public function users()
    {
    	return $this->belongsToMany(User::class);
    }

    public function breeds()
    {
        return $this->hasOne(Breed::class);
    }
}
