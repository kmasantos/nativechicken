<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use LogsActivity;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'last_seen'
    ];

    protected static $logAttributes = ['*'];
    protected static $logName = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function farms()
    {
        return $this->hasOne(Farm::class);
    }

    public function roles()
    {
        return $this->hasOne(Role::class);
    }

    /**
     * Helper functions for User class
     */
    public function getFarm()
    {
        $farm = Farm::where('id', $this->farm_id)->firstOrFail();
        return $farm;
    }

    public function getAnimalType()
    {
        $type = Farm::where('farms.id', $this->farm_id)
        ->leftJoin('breeds', 'farms.breedable_id', 'breeds.id')
        ->firstOrFail();
        return $type->animaltype_id;
    }
}
