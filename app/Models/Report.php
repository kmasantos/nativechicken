<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'year',
        'published_at',
        'archived_at',
    ];
}
