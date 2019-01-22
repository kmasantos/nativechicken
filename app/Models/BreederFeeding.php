<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class BreederFeeding extends Model
{
    use SoftDeletes;
    use LogsActivity;

    public $timestamps = false;
    protected $dates = ['deleted_at'];
    
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
