<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class AccountGold extends Model
{
    use HasFactory, Syncable;

    // Table name (optional if it follows Laravel naming convention)
    protected $table = 'account_gold';

    // Primary key (optional if it's 'id')
    protected $primaryKey = 'id';
    protected $fillable = [
        'party_id',
        'gold',
        'status',
        'remarks',
    ];
    public function party()
    {
        return $this->belongsTo(Party::class, 'party_id');
    }
}
