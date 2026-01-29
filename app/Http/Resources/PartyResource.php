<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class PartyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Gold & Cash balances
        $goldReceived = $this->whenLoaded('accountGolds', fn() => $this->accountGolds->where('status', 'Received')->sum('gold'));
        $goldPaid     = $this->whenLoaded('accountGolds', fn() => $this->accountGolds->where('status', 'Paid')->sum('gold'));
        $goldBalance  = $goldPaid - $goldReceived;

        $cashReceived = $this->whenLoaded('accountCashes', fn() => $this->accountCashes->where('status', 'Received')->sum('cash'));
        $cashPaid     = $this->whenLoaded('accountCashes', fn() => $this->accountCashes->where('status', 'Paid')->sum('cash'));
        $cashBalance  = $cashPaid - $cashReceived;

        // Merge Gold and Cash records
        $goldRecords = collect($this->whenLoaded('accountGolds') 
            ? $this->accountGolds->map(fn($gold) => [
                'id'         => $gold->id,
                'party_id'   => $gold->party_id,
                'amount'     => $gold->gold,
                'remarks'    => $gold->remarks,
                'type'       => 'gold',
                'status'     => $gold->status ?? null,
                'created_by' => $gold->created_by,
                'created_at' => $gold->created_at,
            ])
            : []
        );

        $cashRecords = collect($this->whenLoaded('accountCashes') 
            ? $this->accountCashes->map(fn($cash) => [
                'id'         => $cash->id,
                'party_id'   => $cash->party_id,
                'amount'     => $cash->cash,
                'remarks'    => $cash->remarks,
                'type'       => 'cash',
                'status'     => $cash->status ?? null,
                'created_by' => $cash->created_by,
                'created_at' => $cash->created_at,
            ])
            : []
        );

        $accountDetails = $goldRecords->merge($cashRecords)->sortBy('created_at')->values();

        $lastEntry = $accountDetails->sortByDesc('created_at')->first();
        $lastRemarks = $lastEntry['remarks'] ?? null;

        $lastOrder = $this->whenLoaded('orders', fn() => $this->orders->sortByDesc('created_at')->first());
        $totalOrders = $this->whenLoaded('orders', fn() => $this->orders->count());

      

        return [
            'id'            => $this->partyID,
            'party_type'    => $this->type,
            'created_by'    => $this->created_by,
            'party_regular' => $this->whenLoaded('partyRegular', fn() => [
                'partyID'            => $this->partyRegular->partyID,
                'partyName'          => $this->partyRegular->partyName,
                'businessName'       => $this->partyRegular->businessName,
                'address'            => $this->partyRegular->address,
                'phone'              => $this->partyRegular->phone,
                'totalOrders'        => $this->partyRegular->totalOrders,
                'wasteDiscount'      => $this->partyRegular->wasteDiscount,
                'mazdoriDiscount'    => $this->partyRegular->mazdoriDiscount,
                'wasteDiscount16'    => $this->partyRegular->wasteDiscount16,
                'mazdooriDiscount16' => $this->partyRegular->mazdooriDiscount16,
            ]),
            'gold_summary'  => [
                'received' => $goldReceived,
                'paid'     => $goldPaid,
                'balance'  => $goldBalance,
            ],
            'cash_summary'  => [
                'received' => $cashReceived,
                'paid'     => $cashPaid,
                'balance'  => $cashBalance,
            ],
            'account_details' => $accountDetails,
            'totalOrders'       => $totalOrders ? $totalOrders : null,
            'lastRemarks'  =>$lastRemarks,
        ];
    }
}

