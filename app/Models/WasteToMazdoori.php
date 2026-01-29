<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class WasteToMazdoori extends Model
{
    use HasFactory, Syncable;

    protected $table = 'waste_to_mazdoori';

    protected $fillable = [
        'waste', 'tolla', 'mazdori', 'serial', 'password', 'machineCode'
    ];
}
