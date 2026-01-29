<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class ExpenseGold extends Model
{
    use HasFactory, Syncable;

    protected $table = 'expense_gold';

    protected $fillable = [
        'gold',
        'remarks'
    ];
}
