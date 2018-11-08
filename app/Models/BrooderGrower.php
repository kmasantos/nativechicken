<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrooderGrower extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $dates = ['deleted_at'];
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'brooder_growers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'batching_date', 'date_added'
    ];

    public function families()
    {
        return $this->belongsTo(Family::class);
    }

    public function brooder_grower_inventories()
    {
        return $this->hasMany(BrooderGrowerInventory::class);
    }

    public function brooder_grower_feedings()
    {
        return $this->hasMany(BrooderGrowerFeeding::class);
    }

    public function brooder_grower_growth()
    {
        return $this->hasMany(BrooderGrowerGrowth::class);
    }

    public function getFamily()
    {
        $family = Family::where('id', $this->family_id)->firstOrFail();
        return $family;
    }
}
