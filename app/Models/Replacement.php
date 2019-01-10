<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Replacement extends Model
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
    protected $table = 'replacements';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'batching_date', 'date_added'
    ];

    protected static $logAttributes = ['*'];
    protected static $logName = 'replacements';

    public function families()
    {
        return $this->belongsTo(Family::class);
    }

    public function replacement_inventories()
    {
        return $this->hasMany(ReplacementInventory::class);
    }

    public function replacement_feedings()
    {
        return $this->hasMany(ReplacementFeeding::class);
    }

    public function replacement_pheno_morphos()
    {
        return $this->hasMany(ReplacementPhenoMorpho::class);
    }

    public function getInventories()
    {
        $inventories = ReplacementInventory::where('replacement_id', $this->id)->get();
        return $inventories;
    }

    public function getFamily()
    {
        $family = Family::where('id', $this->family_id)->first();
        return $family;
    }

}
