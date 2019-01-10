<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class MortalitySale extends Model
{
    use LogsActivity;

    public $timestamps = false;
    protected $table = 'mortality_sales';

    protected $fillable = [
        'type', 'category', 'date', 'male', 'female', 'total', 'price', 'reason', 'remarks'
    ];

    protected static $logAttributes = ['*'];
    protected static $logName = 'mortalitys_sales';

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
