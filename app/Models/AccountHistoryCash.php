<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class AccountHistoryCash extends Model
{
    use Syncable;

    protected $fillable = [
        'party_id', 'cash', 'status', 'remarks', 'user_id'
    ];

}
