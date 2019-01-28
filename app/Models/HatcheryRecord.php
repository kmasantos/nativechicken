<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class HatcheryRecord extends Model
{
    use LogsActivity;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
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

    protected static $logAttributes = ['*'];
    protected static $logName = 'hatchery_records';

    public function breeders()
    {
        return $this->belongsTo(Breeder::class);
    }
}
