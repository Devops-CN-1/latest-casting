<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class SystemSetting extends Model
{
    use Syncable;


    protected $fillable = [
        'gold_rate',
        'gram_rate',
        'software_name',
    ];
}
