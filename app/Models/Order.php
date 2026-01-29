<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class Order extends Model
{
    use Syncable;
    protected $fillable = [
    'id','party_id', 'created_by', 'weightReady', 'mailCode', 'mazdoriRate', 'wasteRate', 'tollaRate',
    'goldIN', 'goldOut', 'cashIn','InOutCheck', 'cashOut', 'wasteCasted', 'mazdoorie',
    'InOut', 'Piece', 'remarks', 'selectOption',
    'totalGold', 'totalMazdoori', 'totalMazdooriInGold', 'totalMazdooriInCash',
    'goldInAfter', 'goldOutAfter', 'cashInAfter', 'cashOutAfter',

    // Option 1
    'op1GoldRecieved', 'op1MazdooriRecieved', 'op1GoldPaid', 'op1MazdooriPaid',
    'op1RemainingGold', 'op1RemainingCash',

    // Option 2
    'op2GoldRecieved', 'op2GoldPaid', 'op2RemainingGold', 'op2CashRecieved',
    'op2CashPaid', 'op2RemainingCash',

    // Option 3
    'op3CashRecieved', 'op3CashPaid', 'op3RemainingCash',

    // Extras
    'totalWeight', 'totalWeightCasted', 'khalis', 'advance',
    'totalKhalis', 'remainingMazdoori', 'wapsiGold', 'castingWeight',
];

    //
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by'); // or 'user_id' if that's the foreign key
    }
}
