<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Syncable;

class Party extends Model
{
	use HasFactory, Syncable;
	
		protected $table = 'parties';
		protected $primaryKey = 'partyID';

		public $incrementing = true;

    	protected $keyType = 'int';

	   	protected $fillable = [
	   		'partyID',
	        'type', 
	        'created_by',
	        'goldIn',
	        'goldOut',
	        'goldOut',
	        'cashOut',
	        'totalWasteCasted',
	        'totalMazdoori',
	        'lastOrderDate',
	        'IsActive',

	    ];

	public function partyRegular()
	{
	    return $this->hasOne(PartyRegular::class, 'partyID', 'partyID');
	}

	public function accountGolds()
	{
	    return $this->hasMany(AccountGold::class, 'party_id', 'partyID');
	}

	public function accountCashes()
	{
	    return $this->hasMany(AccountCash::class, 'party_id', 'partyID');
	}
	public function orders()
	{
	    return $this->hasMany(Order::class, 'party_id', 'partyID');
	}

}
