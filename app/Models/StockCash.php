<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class StockCash extends Model
{
    use Syncable;

    protected $table = 'stock_cashes';

    protected $fillable = ['cash', 'status', 'remarks'];
}
