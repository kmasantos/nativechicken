<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Pen extends Model
{
    use Searchable;
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pens';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'type', 'total_capacity', 'current_capacity', 'is_active'
    ];
    
    public function breeder_inventories()
    {
        return $this->hasMany(BreederInventory::class);
    }

    public function replacement_inventories()
    {
        return $this->hasMany(ReplacementInventory::class);
    }

    public function broodergrower_inventories()
    {
        return $this->hasMany(BrooderGrower::class);
    }

    public function animal_movements()
    {
        return $this->hasMany(AnimalMovement::class);
    }

    /**
     * Pen specific functions
    **/
    public function getNumber()
    {
        return $this->number;
    }

    public function getRemainingSlots()
    {
        return $this->total_capacity - $this->current_capacity;
    }

    public function hasSlots()
    {
        if(($this->total_capacity - $this->current_capacity)>0){
            return true;
        }else{
            return false;
        }
    }
}
