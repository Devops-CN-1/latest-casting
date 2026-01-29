<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class AccountHistoryGold extends Model
{
    use Syncable;

    protected $fillable = [
        'party_id', 'gold', 'status', 'remarks', 'user_id'
    ];

}
