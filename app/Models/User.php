<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'last_seen'
    ];

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
}
