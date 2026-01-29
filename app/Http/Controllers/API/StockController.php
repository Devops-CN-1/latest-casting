<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\StockGold;
use App\Models\StockCash;
use App\Models\ExpenseGold;
use App\Models\ExpenseCash;
use App\Models\AccountHistoryGold;
use App\Models\AccountHistoryCash;
use App\Models\Party;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function printData(Request $request)
    {
        $data  = $request->all();
        return view('print.orderprint', compact('data'));
    }

    public function getStockData(Request $request)
    {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;
        $partyId = $request->party_id;



        if (empty($fromDate) && empty($toDate) && empty($partyId)) {
            return response()->json(['error' => 'Please provide date range or party ID'], 400);
        }

        $query = Order::query();

        
            if (!empty($fromDate) && !empty($toDate)) {
                $fromDate = \Carbon\Carbon::parse($fromDate)->startOfDay();
                $toDate = \Carbon\Carbon::parse($toDate)->endOfDay();

                $query->whereBetween('created_at', [$fromDate, $toDate]);
            }

        // If partyId exists
        if (!empty($partyId)) {
            $query->where('party_id', $partyId);
        }
        $orders = $query->get();


        return response()->json(['data' => $orders]);
    }

    public function enteGoldCashStock(Request $request)
    {
        // Validate the request
        $request->validate([
            'goldStock_Enter' => 'nullable|numeric',
            'cashStock_Enter' => 'nullable|numeric',
        ]);

        if (!empty($request->goldStock_Enter) && $request->goldStock_Enter > 0) {
            StockGold::create([
                'gold'    => $request->goldStock_Enter,
                'status'   => 'Received',
                'remarks'  => 'Gold Enter By Owner',
            ]);
        }

        if (!empty($request->cashStock_Enter) && $request->cashStock_Enter > 0) {
            StockCash::create([
                'cash'    => $request->cashStock_Enter,
                'status'   => 'Received',
                'remarks'  => 'Cash Enter By Owner',
            ]);
        }

        $goldReceived = StockGold::where('status', 'Received')->sum('gold');
        $goldPaid = StockGold::where('status', 'Paid')->sum('gold');
        $goldBalance = $goldReceived - $goldPaid;

        $cashReceived = StockCash::where('status', 'Received')->sum('cash');
        $cashPaid = StockCash::where('status', 'Paid')->sum('cash');
        $cashBalance = $cashReceived - $cashPaid;

        // ✅ Prepare JSON response
        $response = [
            'gold' => [
                'received' => $goldReceived,
                'paid'     => $goldPaid,
                'balance'  => $goldBalance,
            ],
            'cash' => [
                'received' => $cashReceived,
                'paid'     => $cashPaid,
                'balance'  => $cashBalance,
            ]
        ];

        return response()->json($response);
    }
    public function stock()
    {
        return view('stock.stock');
    }

    public function checkPassword(Request $request)
    {
        $user = Auth::user();


        if ($request->stock_password === $user->stock_password) {
            Session::put('stock_password', true);
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Your password is wrong.']);
        }
    }

        public function addExpSona(Request $request)
        {
            // ✅ Validate request
            $validated = $request->validate([
                'exp_Sona' => 'required|numeric|min:0',
                'exp_Remarks' => 'required|string|max:255',
            ]);

            // ✅ Store in expense_gold table
            $expenseGold = ExpenseGold::create([
                'gold' => $validated['exp_Sona'],
                'remarks' => $validated['exp_Remarks'],
            ]);

            // ✅ Store in stock_gold table with status = paid
            StockGold::create([
                'gold' => $validated['exp_Sona'],
                'status' => 'paid',
                'remarks' => $validated['exp_Remarks']
            ]);

            return response()->json([
                'message' => 'Expense added successfully!',
                'data' => $expenseGold
            ]);
        }
        public function addExpCash(Request $request)
        {
            $validated = $request->validate([
                'exp_Cash' => 'required|numeric|min:0',
                'exp_Cash_Remarks' => 'required|string|max:255',
            ]);


            // ✅ Store in expense_gold table
            $expenseCash = ExpenseCash::create([
                'cash' => $validated['exp_Cash'],
                'remarks' => $validated['exp_Cash_Remarks'],
            ]);

            // ✅ Store in stock_gold table with status = paid
            StockCash::create([
                'cash' => $validated['exp_Cash'],
                'status' => 'paid',
                'remarks' => $validated['exp_Cash_Remarks']
            ]);

            return response()->json([
                'message' => 'Expense added successfully!',
                'data' => $expenseCash
            ]);
        }

       public function sellSona(Request $request)
        {

            $validated = $request->validate([
                'sell_Sona' => 'required|numeric|min:0',
                'sell_Sona_In_Rupees' => 'required|numeric|min:0',
            ]);



            // ✅ Get total gold in stock
            $goldReceived = StockGold::where('status', 'Received')->sum('gold');
            $goldPaid     = StockGold::where('status', 'Paid')->sum('gold');

            $availableGold = $goldReceived - $goldPaid;


            // ✅ Check if enough stock available
            if ($availableGold < $validated['sell_Sona']) {
                return response()->json([
                    'message' => 'Insufficient gold stock! Available: ' . $availableGold . ' but trying to sell ' . $validated['sell_Sona']
                ], 400);
            }

            // ✅ If enough stock, record the transaction
            StockGold::create([
                'gold'    => $validated['sell_Sona'],
                'status'  => 'Paid',
                'remarks' => 'For Buy Sona'
            ]);

            StockCash::create([
                'cash'    => $validated['sell_Sona_In_Rupees'],
                'status'  => 'Paid',
                'remarks' => 'Rupees to Sona'
            ]);

            return response()->json([
                'message' => 'Transaction successful!',
                'remaining_gold' => $availableGold - $validated['sell_Sona']
            ]);
        }

        public function buySona(Request $request)
        {
            $validated = $request->validate([
                'cash_for_buyGold' => 'required|numeric|min:0',
                'rate_to_buy_gold' => 'required|numeric|min:0',
            ]);

            $calulateGold = ($request->cash_for_buyGold * 11.664) /  $request->rate_to_buy_gold;

            StockGold::create([
                'gold' => $calulateGold,
                'status' => 'Received',
                'remarks' => 'Rupees to Sona'
            ]);

            StockCash::create([
                'cash' => $validated['cash_for_buyGold'],
                'status' => 'paid',
                'remarks' => 'For Buy Sona'
            ]);


            return response()->json([
                'message' => 'Expense added successfully!',
            ]);
        }
    /**
     * Store a newly created resource in storage.
     */
    public function expenseGoldList(){

        $expenseGoldList = ExpenseGold::All();
        return response()->json([
                'message' => 'Expense Gold List',
                'data' => $expenseGoldList
            ]);


    }    

    public function expenseCashList(){

        $expenseCashList = ExpenseCash::All();
        return response()->json([
                'message' => 'Expense Cash List',
                'data' => $expenseCashList
            ]);


    }

    public function stockGoldList(){

        $stockGoldList = StockGold::All();
        return response()->json([
                'message' => 'Stock Gold List',
                'data' => $stockGoldList
            ]);


    }    
    public function stockCashList(){

        $stockCashList = StockCash::All();
        return response()->json([
                'message' => 'Stock Cash List',
                'data' => $stockCashList
            ]);


    }

    public function leenaPartiesSummary()
    {
        $parties = Party::with(['partyRegular', 'accountCashes', 'accountGolds'])->get();

        $result = [];

        foreach ($parties as $party) {
            // Cash calculations
            $cashReceived = $party->accountCashes->where('status', 'Received')->sum('cash');
            $cashPaid = $party->accountCashes->where('status', 'Paid')->sum('cash');
            $cashBalance = $cashPaid -  $cashReceived;

            // Gold calculations
            $goldReceived = $party->accountGolds->where('status', 'Received')->sum('gold');
            $goldPaid = $party->accountGolds->where('status', 'Paid')->sum('gold');
            $goldBalance =$goldPaid - $goldReceived;

            // Apply positive-only logic
            $cashBalance = $cashBalance > 0 ? $cashBalance : 0;
            $goldBalance = $goldBalance > 0 ? $goldBalance : 0;

            // ✅ Skip party if both balances are zero
            if ($cashBalance == 0 && $goldBalance == 0) {
                continue;
            }

            $result[] = [
                'party_id'       => $party->partyID,
                'party_name'     => $party->partyRegular->partyName ?? 'Cash', // Assuming `name` column exists
                'phone_number'   => $party->partyRegular->phone ?? 'NO Fone', // Assuming `name` column exists
                'cash_received'  => $cashReceived,
                'cash_paid'      => $cashPaid,
                'cash_balance'   => $cashBalance,
                'gold_received'  => $goldReceived,
                'gold_paid'      => $goldPaid,
                'gold_balance'   => $goldBalance,
            ];
        }

        return response()->json([
            'message' => 'Party balances fetched successfully',
            'data'    => $result
        ]);
    }

    public function oldRecord(Request $request)
    {
        $fromDate = $request->from_date;
        $toDate   = $request->to_date;
        $partyId  = $request->party_id;

        // Ensure correct order
        if ($fromDate > $toDate) {
            [$fromDate, $toDate] = [$toDate, $fromDate];
        }

        // Get Gold Records
        $goldRecords = AccountHistoryGold::where('party_id', $partyId)
            ->when($fromDate && $toDate, function($query) use ($fromDate, $toDate) {
                $query->whereBetween('created_at', [$fromDate, $toDate]);
            })
            ->get()
            ->map(function($item) {
                $item->type = 'gold';
                return $item;
            });

        // Get Cash Records
        $cashRecords = AccountHistoryCash::where('party_id', $partyId)
            ->when($fromDate && $toDate, function($query) use ($fromDate, $toDate) {
                $query->whereBetween('created_at', [$fromDate, $toDate]);
            })
            ->get()
            ->map(function($item) {
                $item->type = 'cash';
                return $item;
            });

        // Merge and sort all records
        $allRecords = $cashRecords
            ->concat($goldRecords)
            ->sortBy('created_at')
            ->values();

        // ---------- Calculate Totals ----------
        $goldReceived = $goldRecords->where('status', 'Received')->sum('gold');
        $goldPaid     = $goldRecords->where('status', 'Paid')->sum('gold');
        $cashReceived = $cashRecords->where('status', 'Received')->sum('cash');
        $cashPaid     = $cashRecords->where('status', 'Paid')->sum('cash');

        $totals = [
            'gold_received' => $goldReceived,
            'gold_paid'     => $goldPaid,
            'gold_balance'  => $goldPaid - $goldReceived,

            'cash_received' => $cashReceived,
            'cash_paid'     => $cashPaid,
            'cash_balance'  => $cashPaid - $cashReceived,
        ];

        return response()->json([
            'records' => $allRecords,
            'totals'  => $totals,
        ]);
    }



    public function showAllRecords()
    {
        $parties = Party::with(['partyRegular', 'accountCashes', 'accountGolds'])->get();

        $result = [];
        
        // Separate arrays
        $cashPositive = [];
        $cashNegative = [];
        $goldPositive = [];
        $goldNegative = [];

        foreach ($parties as $party) {
            // Cash calculations
            $cashReceived = $party->accountCashes->where('status', 'Received')->sum('cash');
            $cashPaid     = $party->accountCashes->where('status', 'Paid')->sum('cash');
            $cashBalance  = $cashPaid - $cashReceived;

            // Gold calculations
            $goldReceived = $party->accountGolds->where('status', 'Received')->sum('gold');
            $goldPaid     = $party->accountGolds->where('status', 'Paid')->sum('gold');
            $goldBalance  = $goldPaid - $goldReceived;

            $partyData = [
                'party_id'      => $party->partyID,
                'party_name'    => $party->partyRegular->partyName ?? 'Cash',
                'phone_number'  => $party->partyRegular->phone ?? 'NO Fone',
                'cash_received' => $cashReceived,
                'cash_paid'     => $cashPaid,
                'cash_balance'  => $cashBalance,
                'gold_received' => $goldReceived,
                'gold_paid'     => $goldPaid,
                'gold_balance'  => $goldBalance,
            ];

            $result[] = $partyData;

            // Separate balances into arrays
            if ($cashBalance >= 0) {
                $cashPositive[] = $cashBalance;
            } else {
                $cashNegative[] = $cashBalance;
            }

            if ($goldBalance >= 0) {
                $goldPositive[] = $goldBalance;
            } else {
                $goldNegative[] = $goldBalance;
            }
        }

        // Sum the separate arrays
        $cashPositiveSum = array_sum($cashPositive);
        $cashNegativeSum = array_sum($cashNegative);
        $goldPositiveSum = array_sum($goldPositive);
        $goldNegativeSum = array_sum($goldNegative);

        return response()->json([
            'message' => 'Party balances fetched successfully',
            'data'    => $result,
            'summary' => [
                'cash_positive_sum' => $cashPositiveSum,
                'cash_negative_sum' => $cashNegativeSum,
                'gold_positive_sum' => $goldPositiveSum,
                'gold_negative_sum' => $goldNegativeSum,
            ],
        ]);
    }



    public function stockTotal(){

         $stockCashReceived = StockCash::where('status', 'Received')->sum('cash');
         $stockCashPaid = StockCash::where('status', 'Paid')->sum('cash');

         $stockCashBalance =$stockCashReceived -  $stockCashPaid;

         $stockGoldReceived = StockGold::where('status', 'Received')->sum('gold');
         $stockGoldPaid = StockGold::where('status', 'Paid')->sum('gold');

         $stockGoldBalance = $stockGoldReceived - $stockGoldPaid;

        $result = [];

         $result[] = [
                'stockCashBalance'       => $stockCashBalance,
                'stockGoldBalance'     => $stockGoldBalance,
        ];

        return response()->json([
            'message' => 'Stock balances fetched successfully',
            'data'    => $result
        ]);

    }

    public function deenaPartiesSummary()
    {
        $parties = Party::with(['partyRegular', 'accountCashes', 'accountGolds'])->get();

        $result = [];

        foreach ($parties as $party) {
            // Cash calculations
            $cashReceived = $party->accountCashes->where('status', 'Received')->sum('cash');
            $cashPaid = $party->accountCashes->where('status', 'Paid')->sum('cash');
            $cashBalance = $cashPaid -  $cashReceived;

            // Gold calculations
            $goldReceived = $party->accountGolds->where('status', 'Received')->sum('gold');
            $goldPaid = $party->accountGolds->where('status', 'Paid')->sum('gold');
            $goldBalance =$goldPaid - $goldReceived;

            // Apply positive-only logic
            $cashBalance = $cashBalance < 0 ? $cashBalance : 0;
            $goldBalance = $goldBalance < 0 ? $goldBalance : 0;

            // ✅ Skip party if both balances are zero
            if ($cashBalance == 0 && $goldBalance == 0) {
                continue;
            }

            $result[] = [
                'party_id'       => $party->partyID,
                'party_name'     => $party->partyRegular->partyName ?? 'Cash', // Assuming `name` column exists
                'phone_number'   => $party->partyRegular->phone ?? 'NO Fone', // Assuming `name` column exists
                'cash_received'  => $cashReceived,
                'cash_paid'      => $cashPaid,
                'cash_balance'   => $cashBalance,
                'gold_received'  => $goldReceived,
                'gold_paid'      => $goldPaid,
                'gold_balance'   => $goldBalance,
            ];
        }

        return response()->json([
            'message' => 'Party balances fetched successfully',
            'data'    => $result
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Get parties with maximum orders
     */
    public function maxOrder()
    {
        try {
            // Get orders grouped by party_id with count
            $ordersByParty = Order::select('party_id', DB::raw('count(*) as order_count'))
                ->groupBy('party_id')
                ->orderBy('order_count', 'desc')
                ->get();

            $result = [];

            foreach ($ordersByParty as $orderGroup) {
                // Get party information with partyRegular relationship
                $party = Party::with('partyRegular')->where('partyID', $orderGroup->party_id)->first();
                
                if ($party) {
                    $partyName = 'Cash Party'; // Default for cash parties
                    
                    // Get party name from party_regular if it's a regular party
                    if ($party->type === 'regular' && $party->partyRegular) {
                        $partyName = $party->partyRegular->partyName ?? $party->partyRegular->businessName ?? 'Cash Party';
                    }

                    $result[] = [
                        'party_id' => $orderGroup->party_id,
                        'party_name' => $partyName,
                        'order_count' => $orderGroup->order_count
                    ];
                }
            }

            return response()->json([
                'status' => 'success',
                'data' => $result
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error fetching max order data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get parties with maximum waste casted (sum of wasteCasted)
     */
    public function maxWaste()
    {
        try {
            // Get orders grouped by party_id with sum of wasteCasted
            $ordersByParty = Order::select('party_id', DB::raw('SUM(wasteCasted) as total_waste_casted'))
                ->whereNotNull('wasteCasted')
                ->groupBy('party_id')
                ->orderBy('total_waste_casted', 'desc')
                ->get();

            $result = [];

            foreach ($ordersByParty as $orderGroup) {
                // Get party information with partyRegular relationship
                $party = Party::with('partyRegular')->where('partyID', $orderGroup->party_id)->first();
                
                if ($party) {
                    $partyName = 'Cash Party'; // Default for cash parties
                    
                    // Get party name from party_regular if it's a regular party
                    if ($party->type === 'regular' && $party->partyRegular) {
                        $partyName = $party->partyRegular->partyName ?? $party->partyRegular->businessName ?? 'Cash Party';
                    }

                    $result[] = [
                        'party_id' => $orderGroup->party_id,
                        'party_name' => $partyName,
                        'total_waste_casted' => $orderGroup->total_waste_casted ?? 0
                    ];
                }
            }

            return response()->json([
                'status' => 'success',
                'data' => $result
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error fetching max waste data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
