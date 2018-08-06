<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pen extends Model
{
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
    
}
