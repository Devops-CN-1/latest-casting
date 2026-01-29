<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class PartyCash extends Model
{
    use HasFactory, Syncable;

    protected $table = 'party_cash'; // Specify table name
     public $incrementing = false; // Important: allow manual setting of partyID

    protected $primaryKey = 'partyID'; // Primary key is not 'id'

    protected $fillable = [
        'status',
    ];

    public $timestamps = true; // Enable created_at and updated_at
}
