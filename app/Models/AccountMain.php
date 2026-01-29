<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class AccountMain extends Model
{
    use HasFactory, Syncable;

    // Explicit table name since it's not plural ("account_main" instead of "account_mains")
    protected $table = 'account_main';

    // Allow mass assignment for these fields
    protected $fillable = [
        'partyID',
        'recievedGoldLast',
        'paidGoldLast',
        'recievedCashLast',
        'paidCashLast',
        'goldRate',
        'gold',
        'goldStatus',
        'cash',
        'cashStatus',
        'hawala',
        'addGold',
    ];


    public function party()
    {
        return $this->belongsTo(Party::class, 'partyID', 'id');
    }
}
