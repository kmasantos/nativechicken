<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class BreederInventory extends Model
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
    protected $table = 'breeder_inventories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_removed', 'number_male', 'number_female', 'total', 'activity', 'reason'
    ];

    protected static $logAttributes = ['*'];
    protected static $logName = 'breeder_inventories';

    public function breeders()
    {
        return $this->belongsTo(Breeder::class);
    }

    public function pens()
    {
        return $this->belongsTo(Pen ::class);
    }

    // Model Functions
    public function getBreederData()
    {
        return Breeder::where('id', $this->breeder_id)->first();
    }
}
