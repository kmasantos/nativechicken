<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class EggQuality extends Model
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
    protected $table = 'egg_qualities';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_collected', 'egg_quality_at', 'weight', 'color',
        'shape', 'length', 'width', 'albumen_height', 'albumen_weight',
        'yolk_weight', 'yolk_color', 'shell_weight', 'thickness_top',
        'thickness_mid', 'thickness_bot'
    ];

    protected static $logAttributes = ['*'];
    protected static $logName = 'egg_qualities';
    
    public function breeders()
    {
        return $this->belongsTo(Breeder::class);
    }
}
