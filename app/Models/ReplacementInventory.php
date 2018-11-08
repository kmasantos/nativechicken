<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReplacementInventory extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $dates = ['deleted_at'];
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'replacement_inventories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number_male', 'number_female', 'total', 'activity', 'date'
    ];

    public function replacements()
    {
        return $this->belongsTo(Replacement::class);
    }

    public function pens()
    {
        return $this->belongsTo(Pen::class);
    }
}
