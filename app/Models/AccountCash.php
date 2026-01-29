<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class AccountCash extends Model
{
    use HasFactory, Syncable;

    // Table name (because it's not plural in standard form)
    protected $table = 'account_cash';

    // Fillable fields
    protected $fillable = [
        'party_id',
        'cash',
        'status',
        'remarks',
    ];

    // Relationship with Party
    public function party()
    {
        return $this->belongsTo(Party::class, 'party_id');
    }
}
