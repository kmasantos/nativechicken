<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrooderGrowerInventory extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'brooder_grower_inventories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number_male', 'number_female', 'total', 'activity', 'date'
    ];

    public function brooder_growers()
    {
        return $this->belongsTo(BrooderGrower::class);
    }   

    public function pens()
    {
        return $this->belongsTo(Pen::class);
    }
}
