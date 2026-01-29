<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class ExpenseCash extends Model
{
    use HasFactory, Syncable;

    protected $table = 'expense_cash';

    protected $fillable = [
        'cash',
        'remarks'
    ];
}
