<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplacementGrowth extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'replacement_growths';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'collection_day', 'date_collected', 'male_quantity', 'male_weight',
        'female_quantity', 'female_weight', 'total_quantity', 'total_weight'
    ];

    public function replacement_inventories()
    {
        return $this->belongsTo(ReplacementInventory::class);
    }

}
