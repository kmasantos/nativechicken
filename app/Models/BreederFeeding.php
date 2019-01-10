<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BreederFeeding extends Model
{
    use LogsActivity;

    public $timestamps = false;
    
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'breeder_feedings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_collected', 'amount_offered', 'amount_refused', 'remarks'
    ];

    protected static $logAttributes = ['*'];
    protected static $logName = 'breeder_feedings';

    public function breeders()
    {
        return $this->belongsTo(Breeder::class);
    }
    
}
