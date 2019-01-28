<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReplacementFeeding extends Model
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
    protected $table = 'replacement_feedings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_collected', 'amount_offered', 'amount_refused', 'remarks'
    ];

    protected static $logAttributes = ['*'];
    protected static $logName = 'replacement_feedings';

    public function replacements()
    {
        return $this->belongsTo(Replacement::class);
    }

}
