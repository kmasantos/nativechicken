<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MortalitySale extends Model
{
    public $timestamps = false;
    protected $table = 'mortality_sales';

    protected $fillable = [
        'type', 'category', 'date', 'male', 'female', 'total', 'price', 'reason', 'remarks'
    ];

    public function breeder_inventory()
    {
        return $this->belongsTo(BreederInventory::class);
    }

    public function replacement_inventory()
    {
        return $this->belongsTo(ReplacementInventory::class);
    }

    public function brooder_inventory()
    {
        return $this->belongsTo(BrooderGrowerInventory::class);
    }
}
