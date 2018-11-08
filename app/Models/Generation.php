<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Generation extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $dates = ['deleted_at'];
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'generations';
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
        return $this->hasMany(Lines::class);
    }
}
