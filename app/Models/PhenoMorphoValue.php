<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PhenoMorphoValue extends Model
{
    use LogsActivity;

    public $timestamps = false;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pheno_morpho_values';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender', 'tag', 'phenotypic', 'morphometric', 'date_collected'
    ];

    protected static $logAttributes = ['*'];
    protected static $logName = 'pheno_morpho_values';

    public function pheno_morpho_values()
    {
        return $this->belongsTo(PhenoMorpho::class);
    }
}
