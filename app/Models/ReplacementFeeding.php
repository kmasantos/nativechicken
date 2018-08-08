<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplacementFeeding extends Model
{
    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'replacement_feedings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_collected', 'amount_offered', 'amount_refused', 'remarks'
    ];

    public function replacements()
    {
        return $this->belongsTo(Replacement::class);
    }

}
