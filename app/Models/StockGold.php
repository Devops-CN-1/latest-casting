<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class StockGold extends Model
{
    use Syncable;

    protected $table = 'stock_gold';

    protected $fillable = ['gold', 'status', 'remarks'];

}
