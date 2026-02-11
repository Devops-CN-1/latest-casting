<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Party;
use App\Models\PartyRegular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PartyResource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\StockGold;
use App\Models\StockCash;
use App\Models\AccountHistoryGold;
use App\Models\AccountHistoryCash;
use App\Models\AccountCash;
use App\Models\AccountGold;
use App\Models\AccountMain;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function createform()
    {
        // Get the last party record based on party_number
        $lastParty = Party::orderBy('partyID', 'desc')->first();


        // If last party exists, increment its party_number, otherwise start from 1
        $nextPartyNumber = $lastParty ? $lastParty->partyID + 1 : 1;

        return view('parties.create', compact('nextPartyNumber'));
    }

    public function advanceform(){
        return view('advance.advance_create');
    }

    public function getRegularParties(Request $request)
    {
        $parties = Party::with('partyRegular')->where('type', 'regular')->get();
        return response()->json([
            'status' => 'success',
            'data' => $parties
        ]);
    }

    public function getCashParties(Request $request)
    {
        $parties = Party::where('type', 'cash')->get();
        return response()->json([
            'status' => 'success',
            'data' => $parties
        ]);
    }

    public function getPartiesStatus()
    {
       $parties = Party::where('type', 'cash')->get();
        $freeUsers = [];
        $nonFreeUsers = [];
        foreach ($parties as $party) {
            // Sum of cash transactions (paid and received)
            $cashPaid = AccountCash::where('party_id', $party->partyID)
                ->where('status', 'paid')
                ->sum('cash');

            $cashReceived = AccountCash::where('party_id', $party->partyID)
                ->where('status', 'received')
                ->sum('cash');

            $totalCash = $cashPaid - $cashReceived;

            // Sum of gold transactions (paid and received)
            $goldPaid = AccountGold::where('party_id', $party->partyID)
                ->where('status', 'paid')
                ->sum('gold');

            $goldReceived = AccountGold::where('party_id', $party->partyID)
                ->where('status', 'received')
                ->sum('gold');

            $totalGold = $goldPaid - $goldReceived;


            if ($totalCash == 0 && $totalGold == 0) {
                $freeUsers[] = $party;
            } else {
                $nonFreeUsers[] = $party;
            }
        }

        return response()->json([
            'free_users' => $freeUsers,
            'non_free_users' => $nonFreeUsers
        ]);
    }


    public function index()
    {
        //
         try {
            // Eager load the user relationship with only needed columns
            $parties = Party::with(['user:id,name,email']) // adjust columns as needed
                            ->select(['id', 'name','party_type', 'created_by','TotalOrders']) // add only the necessary fields
                            ->get();

            return response()->json([
                'response_code' => 200,
                'status'        => 'success',
                'message'       => 'Fetched all parties with users',
                'data'          => $parties,
            ]);

        } catch (\Throwable $e) {
            Log::error('Failed to fetch parties with user', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'response_code' => 500,
                'status'        => 'error',
                'message'       => 'Unable to fetch parties with user.',
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */


    // public function store(Request $request)
    // {
    //     try {
    //         // Step 1: Validate party_type first
    //         $request->validate([
    //             'party_type' => 'required|string|in:cash,gold',
    //         ]);

    //         $partyType = $request->input('party_type');
    //         $data = [
    //             'party_type'  => $partyType,
    //             'created_by'  => Auth::id(),
    //         ];

    //         if ($partyType === 'cash') {
    //             $data['name']        = 'Cash';
    //             $data['business']    = 'free';
    //             $data['waste']       = null;
    //             $data['waste16']     = null;
    //             $data['mazdoorie']   = null;
    //             $data['mazdoorie16'] = null;
    //             $data['Address']     = null;
    //             $data['Phone']       = null;
    //             $data['TotalOrders'] = null;

    //         } else {
    //             // Step 2: Validate gold fields
    //             $validated = $request->validate([
    //                 'name'         => 'required|string|max:255|unique:parties,name',
    //                 'business'     => 'required|string|max:255',
    //                 'Address'      => 'required|string|max:255',
    //                 'Phone'        => 'required|string|max:255',
    //                 'TotalOrders'  => 'required|string|max:255',

    //                 'waste'        => 'nullable|numeric',
    //                 'waste16'      => 'nullable|numeric',
    //                 'mazdoorie'    => 'nullable|numeric',
    //                 'mazdoorie16'  => 'nullable|numeric',
    //             ]);

    //             $data = array_merge($data, $validated);
    //         }

    //         // Step 3: Create the party
    //         $party = Party::create($data);

    //         return response()->json([
    //             'response_code' => 201,
    //             'status'        => 'success',
    //             'message'       => 'Party created successfully',
    //             'data'          => $party,
    //         ], 201);

    //     } catch (ValidationException $e) {
    //         return response()->json([
    //             'response_code' => 422,
    //             'status'        => 'error',
    //             'message'       => 'Validation failed',
    //             'errors'        => $e->errors(),
    //         ], 422);

    //     } catch (\Throwable $e) {
    //         Log::error('Party Creation Error: ' . $e->getMessage());

    //         return response()->json([
    //             'response_code' => 500,
    //             'status'        => 'error',
    //             'message'       => 'Party creation failed',
    //         ], 500);
    //     }
    // }


        public function storePartyAdvance(Request $request)
        {
            try {
                DB::beginTransaction();


                $party = Party::with([
                    'partyRegular',
                    'accountCashes' => function($q) {
                        $q->latest()->take(1);
                    },
                    'accountGolds' => function($q) {
                        $q->latest()->take(1);
                    }
                ])->where('partyID', $request->partyId)->first();

                // Get last Paid/Received separately
                $lastCashPaid = $party->accountCashes()
                    ->where('status', 'Paid')
                    ->latest()
                    ->first();

                $lastCashReceived = $party->accountCashes()
                    ->where('status', 'Received')
                    ->latest()
                    ->first();

                $lastGoldPaid = $party->accountGolds()
                    ->where('status', 'Paid')
                    ->latest()
                    ->first();

                $lastGoldReceived = $party->accountGolds()
                    ->where('status', 'Received')
                    ->latest()
                    ->first();

                if (!empty($request->gold) && $request->gold > 0) {

                    $gold = $request->gold; 
                    $goldStatus=  $request->gold_in_out;
                    
                }

                if (!empty($request->cash) && $request->cash > 0) {

                    $cash = $request->cash;
                    $cashStatus   = $request->cash_in_out;
                   
                }


                AccountMain::create([
                    'partyID'          => $request->partyId,   // required
                    'recievedGoldLast' => $lastGoldReceived->gold ?? 0,
                    'paidGoldLast'     => $lastGoldPaid->gold ?? 0,
                    'recievedCashLast' => $lastCashReceived->cash ?? 0,
                    'paidCashLast'     => $lastCashPaid->cash ?? 0,

                    'goldRate'         => $request->goldRate ?? 0,
                    'gold'             => $gold ?? 0,
                    'goldStatus'       => $goldStatus ?? null,

                    'cash'             => $cash ?? 0,
                    'cashStatus'       => $goldStatus ?? null,

                    'hawala'           => $request->hawala ?? 0,
                    'addGold'          => 0 ,
                ]);

                // Gold entry
                if (!empty($request->gold) && $request->gold > 0) {
                    StockGold::create([
                        'gold' => $request->gold,
                        'status' => $request->gold_in_out,
                        'remarks' => $request->partyId . " Acc say"
                    ]);

                    AccountHistoryGold::create([
                        'party_id' => $request->partyId,
                        'gold' => $request->gold,
                        'status' => $request->gold_in_out,
                        'remarks' => $request->hawala,
                        'user_id' => Auth::id()
                    ]);

                    AccountGold::create([
                        'party_id' => $request->partyId,
                        'gold' => $request->gold,
                        'status' => $request->gold_in_out,
                        'remarks' => $request->hawala
                    ]);
                }

                // Cash entry
                if (!empty($request->cash) && $request->cash > 0) {
                    StockCash::create([
                        'cash' => $request->cash,
                        'status' => $request->cash_in_out,
                        'remarks' => $request->partyId . " Acc say"
                    ]);

                    AccountHistoryCash::create([
                        'party_id' => $request->partyId,
                        'cash' => $request->cash,
                        'status' => $request->cash_in_out,
                        'remarks' => $request->hawala,
                        'user_id' => Auth::id()
                    ]);

                    AccountCash::create([
                        'party_id' => $request->partyId,
                        'cash' => $request->cash,
                        'status' => $request->cash_in_out,
                        'remarks' => $request->hawala
                    ]);
                }
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Party advance stored successfully.'
                ], 200);

            } catch (Exception $e) {
                DB::rollBack();

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to store party advance.',
                    'error' => $e->getMessage()
                ], 500);
            }
        }
    public function store(Request $request)
        {

            DB::beginTransaction();

            try {
                // Validate request: partyID is the number from newPartyId (required for create)
                $request->validate([
                    'type' => 'required|in:regular,cash',
                    'partyID' => 'required|integer|min:1',
                ]);

                $partyID = (int) $request->partyID;

                // Check if party with this ID already exists
                if (Party::find($partyID)) {
                    return response()->json([
                        'message' => 'Party already exists.',
                    ], 422);
                }

                // Create Party with the given partyID
                $party = Party::create([
                    'partyID' => $partyID,
                    'type' => $request->type,
                    'IsActive' => $request->IsActive ?? 1,
                    'created_by'  => Auth::id(),
                    'goldIn' => $request->goldIn ?? 0,
                    'goldOut' => $request->goldOut ?? 0,
                    'cashIn' => $request->cashIn ?? 0,
                    'cashOut' => $request->cashOut ?? 0,
                    'totalWasteCasted' => $request->totalWasteCasted ?? 0,
                    'totalMazdoori' => $request->totalMazdoori ?? 0,
                    'lastOrderDate' => $request->lastOrderDate,
                ]);

                $partyRegular = null;

                // If party is regular, create record in party_regular
                if ($request->type === 'regular') {
                    $partyRegular = PartyRegular::create([
                        'partyID' => $party->partyID,
                        'partyName' => $request->partyName,
                        'businessName' => $request->businessName,
                        'address' => $request->address,
                        'phone' => $request->phone,
                        'totalOrders' => 0,
                        'wasteDiscount' => $request->wasteDiscount ?? 0,
                        'mazdoriDiscount' => $request->mazdoriDiscount ?? 0,
                        'wasteDiscount16' => $request->wasteDiscount16 ?? 0,
                        'mazdooriDiscount16' => $request->mazdooriDiscount16 ?? 0,
                    ]);
                }

                DB::commit();

                return response()->json([
                    'message' => 'Party created successfully',
                    'party' => $party,
                    'party_regular' => $partyRegular
                ], 201);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'message' => 'Error creating party',
                    'error' => $e->getMessage()
                ], 500);
            }
        }




    /**
     * Display the specified resource.
     */
    public function oldparchies($id)
    {
        $orders = DB::table('orders')
                    ->where('party_id', $id)
                    ->select('id', 'created_at')
                    ->get(); // returns collection of objects [{id:..., created_at:...}]

        return response()->json($orders);
    }

    function orderRecord($id){
        $orders = DB::table('orders')->find($id);
        return response()->json($orders);
       
    }


    public function show($id)
    {

        try {


            $party = Party::with('partyRegular','accountGolds','accountCashes', 'orders')->find($id); 
            // $party->load(['user:id,name,email']); // keep it light

             if (!$party) {
                return response()->json([
                    'response_code' => 201,
                    'status'        => 'error',
                    'message'       => 'Party not found.',
                    'data'          => null,
                ]);
            }

            return (new PartyResource($party))
                ->additional([
                    'response_code' => 200,
                    'status'        => 'success',
                    'message'       => 'Party fetched successfully',
                ]);
        } catch (\Throwable $e) {
            Log::error('Failed to show party', ['exception' => $e]);

            return response()->json([
                'response_code' => 500,
                'status'        => 'error',
                'message'       => 'Unable to fetch party.',
                'errors'        => $e->getMessage(),
            ], 500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Party $party)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
        {
            DB::beginTransaction();

            try {
                // Validate request
                $request->validate([
                    'type' => 'required|in:regular,cash',
                ]);

                // Find Party
                $party = Party::findOrFail($id);

                // Update Party common fields
                $party->update([
                    'totalWasteCasted' => $request->totalWasteCasted ?? $party->totalWasteCasted,
                    'totalMazdoori' => $request->totalMazdoori ?? $party->totalMazdoori,
                    'lastOrderDate' => $request->lastOrderDate ?? $party->lastOrderDate,
                ]);

                $partyRegular = null;

                // If party is regular, update the party_regular table
                if ($party->type === 'regular') {
                    $partyRegular = PartyRegular::where('partyID', $party->partyID)->first();

                    if ($partyRegular) {
                        $partyRegular->update([
                            'partyName' => $request->partyName ?? $partyRegular->partyName,
                            'businessName' => $request->businessName ?? $partyRegular->businessName,
                            'address' => $request->address ?? $partyRegular->address,
                            'phone' => $request->phone ?? $partyRegular->phone,
                            'wasteDiscount' => $request->wasteDiscount ?? $partyRegular->wasteDiscount,
                            'mazdoriDiscount' => $request->mazdoriDiscount ?? $partyRegular->mazdoriDiscount,
                            'wasteDiscount16' => $request->wasteDiscount16 ?? $partyRegular->wasteDiscount16,
                            'mazdooriDiscount16' => $request->mazdooriDiscount16 ?? $partyRegular->mazdooriDiscount16,
                        ]);
                    } else {
                        // If no record found, create it (optional)
                        $partyRegular = PartyRegular::create([
                            'partyID' => $party->partyID,
                            'partyName' => $request->partyName,
                            'businessName' => $request->businessName,
                            'address' => $request->address,
                            'phone' => $request->phone,
                            'wasteDiscount' => $request->wasteDiscount ?? 0,
                            'mazdoriDiscount' => $request->mazdoriDiscount ?? 0,
                            'wasteDiscount16' => $request->wasteDiscount16 ?? 0,
                            'mazdooriDiscount16' => $request->mazdooriDiscount16 ?? 0,
                        ]);
                    }
                }

                DB::commit();

                return response()->json([
                    'message' => 'Party updated successfully',
                    'party' => $party,
                    'party_regular' => $partyRegular
                ], 200);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'message' => 'Error updating party',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

    // public function update(Request $request, $id)
    // {
    //     // return 'inside update';
    //     $party = Party::findOrFail($id);

    //     // return $party;

    //     // 1) Block updates if this party is cash
    //     if ($party->party_type === 'cash') {
    //         return response()->json([
    //             'response_code' => 403,
    //             'status'        => 'error',
    //             'message'       => 'Cash party cannot be updated',
    //         ], 403);
    //     }

    //     try {
    //         // 2) Disallow sending/altering party_type (optional but recommended)
    //         if ($request->filled('party_type')) {
    //             return response()->json([
    //                 'response_code' => 422,
    //                 'status'        => 'error',
    //                 'message'       => 'Validation failed',
    //                 'errors'        => [
    //                     'party_type' => ['party_type cannot be updated'],
    //                 ],
    //             ], 422);
    //         }

    //         // 3) Validate incoming fields (all are optional on update, but if present they must pass)
    //         $validated = $request->validate([
    //             'name'         => 'sometimes|required|string|max:255',
    //             'business'     => 'sometimes|required|string|max:255',
    //             'Address'      => 'sometimes|required|string|max:255',
    //             'Phone'        => 'sometimes|required|string|max:255',
    //             'TotalOrders'  => 'sometimes|required|string|max:255',

    //             'waste'        => 'nullable|numeric',
    //             'waste16'      => 'nullable|numeric',
    //             'mazdoorie'    => 'nullable|numeric',
    //             'mazdoorie16'  => 'nullable|numeric',
    //         ]);

    //         // 4) Manual UNIQUE check for name (gold only)
    //         if (array_key_exists('name', $validated)) {
    //             $exists = Party::where('name', $validated['name'])
    //                 ->where('id', '!=', $party->partyID)
    //                 ->exists();

    //             if ($exists) {
    //                 return response()->json([
    //                     'response_code' => 422,
    //                     'status'        => 'error',
    //                     'message'       => 'Validation failed',
    //                     'errors'        => [
    //                         'name' => ['The name should be different'],
    //                     ],
    //                 ], 422);
    //             }
    //         }

    //         // 5) Update
    //         $party->update($validated);

    //         return response()->json([
    //             'response_code' => 200,
    //             'status'        => 'success',
    //             'message'       => 'Party updated successfully',
    //             'data'          => $party->fresh(),
    //         ], 200);

    //     } catch (ValidationException $e) {
    //         return response()->json([
    //             'response_code' => 422,
    //             'status'        => 'error',
    //             'message'       => 'Validation failed',
    //             'errors'        => $e->errors(),
    //         ], 422);

    //     } catch (\Throwable $e) {
    //         Log::error('Party Update Error: ' . $e->getMessage());

    //         return response()->json([
    //             'response_code' => 500,
    //             'status'        => 'error',
    //             'message'       => 'Party update failed',
    //         ], 500);
    //     }
    // }


    /**
     * Remove the specified resource from storage.
     */


    public function destroy($id)
    {
         try {
            $party = Party::find($id);

            if (!$party) {
                return response()->json([
                    'response_code' => 200,
                    'status'        => 'error',
                    'message'       => 'Party not found or already deleted.',
                ]);
            }

            $party->delete();

            return response()->json([
                'response_code' => 200,
                'status'        => 'success',
                'message'       => 'Party deleted successfully.',
            ]);
        } catch (\Throwable $e) {
            \Log::error('Failed to delete party', [
                'party_id'  => $id,
                'exception' => $e,
            ]);

            return response()->json([
                'response_code' => 500,
                'status'        => 'error',
                'message'       => 'Unable to delete party.',
                'errors'        => $e->getMessage(),
            ], 500);
        }
    }
}




