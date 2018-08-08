<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HatcheryRecord extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hatchery_records';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_eggs_set', 'batching_date', 'number_eggs_set', 'week_of_lay', 
        'number_fertile', 'number_hatched', 'date_hatched'
    ];

    public function breeders()
    {
        return $this->belongsTo(Breeder::class);
    }
}
