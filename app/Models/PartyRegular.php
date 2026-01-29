<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class PartyRegular extends Model
{
    use HasFactory, Syncable;

    // Table name
    protected $table = 'party_regular';

    // Primary key
    protected $primaryKey = 'partyID';

    // Enable auto-increment for custom PK
    public $incrementing = true;

    // Primary key type
    protected $keyType = 'int';

    // Fillable fields
    protected $fillable = [
        'partyID',
        'partyName',
        'businessName',
        'address',
        'phone',
        'totalOrders',
        'wasteDiscount',
        'mazdoriDiscount',
        'wasteDiscount16',
        'mazdooriDiscount16',
    ];

    public function party()
    {
        return $this->belongsTo(Party::class, 'partyID', 'partyID');
    }


}

