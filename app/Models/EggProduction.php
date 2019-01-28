<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class EggProduction extends Model
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
    protected $table = 'egg_productions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_collected', 'total_eggs_intact', 'total_egg_weight', 'total_broken', 
        'total_rejects', 'remarks'
    ];

    protected static $logAttributes = ['*'];
    protected static $logName = 'egg_productions';

    public function breeders()
    {
        return $this->belongsTo(Breeder::class);
    }

}
