<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Generation extends Model
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
    protected $table = 'generations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'is_active'
    ];

    protected static $logAttributes = ['*'];
    protected static $logName = 'generations';

    public function lines()
    {
        return $this->hasMany(Lines::class);
    }

    public function getLines()
    {
        $line = Line::where('generation_id', $this->id)->where('is_active', true)->get();
        return $line;
    }
}
