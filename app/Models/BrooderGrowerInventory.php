<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrooderGrowerInventory extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $dates = ['deleted_at'];
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'brooder_grower_inventories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number_male', 'number_female', 'total', 'activity', 'date'
    ];

    public function brooder_growers()
    {
        return $this->belongsTo(BrooderGrower::class);
    }

    public function pens()
    {
        return $this->belongsTo(Pen::class);
    }

    public function getBrooderData ()
    {
        return BrooderGrower::where('id', $this->broodergrower_id)->first();
    }
}
