<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Line extends Model
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
    protected $table = 'lines';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'is_active'
    ];

    protected static $logAttributes = ['*'];
    protected static $logName = 'lines';

    public function generations()
    {
        return $this->belongsTo(Generation::class);
    }

    public function families()
    {
        return $this->hasMany(Family::class);
    }
}
