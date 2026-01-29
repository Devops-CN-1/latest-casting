<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Party;
use App\Models\WasteToMazdoori;
use App\Models\PartyRegular;
use App\Models\StockGold;
use App\Models\StockCash;
use App\Models\AccountHistoryGold;
use App\Models\AccountHistoryCash;
use App\Models\AccountCash;
use App\Models\AccountGold;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    

    public function create()
    {
        // Remove session value
        session()->forget('stock_password');

        // Check if SystemSetting table is empty
        if (SystemSetting::count() == 0) {
            return redirect('/system-settings');
        }

        // Otherwise load your order page
        return view('order.create');
    }
    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        DB::beginTransaction(); // ✅ Start transaction

        try {
            $validatedData = $request->validate([
                'party_id'            => 'required',
                // 'weightReady'         => 'required',
                'mailCode'            => 'required|numeric',
                'wasteRate'           => 'required|numeric',
                'tollaRate'           => 'required|numeric',
                'wasteCasted'         => 'required|numeric',
                'totalWeight'         => 'required|numeric',
                'totalWeightCasted'   => 'required|numeric',
                'khalis'              => 'required|numeric',
                'totalKhalis'         => 'required|numeric',
            ]);

            $user = auth()->user();

            // ✅ Create Order
            $order = Order::create([
                'party_id' => $request->party_id,
                'created_by' => Auth::id(),
                'weightReady' => $request->netWeight,
                'mailCode' => $request->mailCode,
                'mazdoriRate' => $request->mazdoriRate ?? 0,
                'wasteRate' => $request->wasteRate,
                'tollaRate' => $request->tollaRate ?? 0,
                'goldIN' => $request->goldIN ?? 0,
                'goldOut' => $request->goldOut ?? 0,
                'cashIn' => $request->cashIn ?? 0,
                'cashOut' => $request->cashOut ?? 0,
                'wasteCasted' => $request->wasteCasted,
                'mazdoorie' => $request->mazdoorie ?? 0,
                'InOutCheck' => $request->InOutCheck ?? 0,
                'InOut' => $request->InOut ?? null,
                'Piece' => $request->Piece ?? 0,
                'remarks' => $request->remarks ?? null,
                'selectOption' => $request->selectOption ?? 'op1',
                'totalGold' => $request->totalKhalis ?? 0,
                'totalMazdoori' => $request->totalMazdoori ?? 0,
                'totalMazdooriInGold' => $request->totalMazdooriInGold ?? 0,
                'totalMazdooriInCash' => $request->totalMazdooriInCash ?? 0,

                // 'goldInAfter' => $request->op1GoldRecieved ?? 0,
                // 'goldOutAfter' => $request->op1GoldPaid ?? 0,
                // 'cashInAfter' => $request->op1MazdooriRecieved ?? 0,
                // 'cashOutAfter' => $request->op1MazdooriPaid ?? 0,

                // ✅ Option 1
                'op1GoldRecieved' => $request->op1GoldRecieved ?? 0,
                'op1MazdooriRecieved' => $request->op1MazdooriRecieved ?? 0,
                'op1GoldPaid' => $request->op1GoldPaid ?? 0,
                'op1MazdooriPaid' => $request->op1MazdooriPaid ?? 0,
                'op1RemainingGold' => $request->op1RemainingGold ?? 0,
                'op1RemainingCash' => $request->op1RemainingCash ?? 0,

                // ✅ Option 2
                'op2GoldRecieved' => $request->op2GoldRecieved ?? 0,
                'op2GoldPaid' => $request->op2GoldPaid ?? 0,
                'op2RemainingGold' => $request->op2RemainingGold ?? 0,
                'op2CashRecieved' => $request->op2CashRecieved ?? 0,
                'op2CashPaid' => $request->op2CashPaid ?? 0,
                'op2RemainingCash' => $request->op2RemainingCash ?? 0,

                // ✅ Option 3
                'op3CashRecieved' => $request->op3CashRecieved ?? 0,
                'op3CashPaid' => $request->op3CashPaid ?? 0,
                'op3RemainingCash' => $request->op3RemainingCash ?? 0,

                // ✅ Weights & Extra Info
                'totalWeight' => $request->totalWeight,
                'totalWeightCasted' => $request->totalWeightCasted,
                'khalis' => $request->khalis,
                'advance' => $request->advance ?? 0,
                'totalKhalis' => $request->totalKhalis,
                'remainingMazdoori' => $request->remainingMazdoori ?? 0,
                'wapsiGold' => $request->wapsiGold ?? 0,
                'castingWeight' => $request->weightCastig ?? 0
            ]);

            $party = Party::find($request->party_id);
            if ($party) {
                $party->totalWasteCasted += $request->wasteCasted;
                $party->totalMazdoori += ($request->mazdoorie ?? 0);
                $party->save();

                // ✅ Check if party is regular and update the party_regular table
                if ($party->type === 'regular') {
                    $PartyRegular = PartyRegular::find($request->party_id);
                    $PartyRegular->totalOrders += 1;
                    $PartyRegular->save();
                    
                }

            }

             

            

            WasteToMazdoori::create([
                'waste' => $request->wasteCasted,
                'mazdori' => $request->mazdoorie,
                'tolla' => $request->tollaRate,
                'serial' => $order->id,
                'password' => bcrypt('secret123'), // if you want hashed password
                'machineCode' => 'MC9876'
            ]);

            if($request->selectOption == "op1"){

                $party = Party::with(['partyRegular', 'accountCashes', 'accountGolds'])
                    ->where('partyID', $request->party_id)
                    ->first();

                if ($party) {
                    $cashReceived = $party->accountCashes->where('status', 'Received')->sum('cash');
                    $cashPaid     = $party->accountCashes->where('status', 'Paid')->sum('cash');
                    $cashBalance  = $cashPaid - $cashReceived;

                    $goldReceived = $party->accountGolds->where('status', 'Received')->sum('gold');
                    $goldPaid     = $party->accountGolds->where('status', 'Paid')->sum('gold');
                    $goldBalance  = $goldPaid - $goldReceived;

                    $ordercheck = Order::find($order->id); // Make sure $order exists

                    if ($ordercheck) {
                        $ordercheck->goldIn      = $goldReceived ?? 0;
                        $ordercheck->goldOut     = $goldPaid ?? 0;
                        $ordercheck->cashIn      = $cashReceived ?? 0;
                        $ordercheck->cashOut     = $cashPaid ?? 0;

                        $ordercheck->goldInAfter  = $request->op1GoldRecieved ?? 0;
                        $ordercheck->goldOutAfter = ($request->op1GoldPaid ?? 0) + ($request->op1khalasGold ?? 0);
                        $ordercheck->cashInAfter  = $request->op1MazdooriRecieved ?? 0;
                        $ordercheck->cashOutAfter = ($request->op1MazdooriPaid ?? 0) + ($request->totalMazdoori ?? 0);

                        $ordercheck->save();
                    }


                    $party->goldIn = $goldReceived;
                    $party->goldOut = $goldPaid;
                    $party->cashIn = $cashReceived;
                    $party->cashOut = $cashPaid;

                    $party->save();



                }



                            // If op1khalasGold > 0
                AccountGold::where('party_id', $request->party_id)->delete();

                if (!empty($request->op1khalasGold) && $request->op1khalasGold > 0) {
                    AccountGold::create([
                        'party_id' => $request->party_id,
                        'gold' => $request->op1khalasGold,
                        'status' => 'Paid',
                        'remarks' => $request->remarks
                    ]);
                }

                // If op1GoldRecieved > 0
                if (!empty($request->op1GoldRecieved) && $request->op1GoldRecieved > 0) {
                    AccountGold::create([
                        'party_id' => $request->party_id,
                        'gold' => $request->op1GoldRecieved,
                        'status' => 'Received',
                        'remarks' => $request->remarks.'--'. str_pad($order->id, 6, '0', STR_PAD_LEFT) . '-Received-'.$request->mailCode
                    ]);
                }

                // If op1GoldPaid > 0
                if (!empty($request->op1GoldPaid) && $request->op1GoldPaid > 0) {
                    AccountGold::create([
                        'party_id' => $request->party_id,
                        'gold' => $request->op1GoldPaid,
                        'status' => 'Paid',
                        'remarks' => $request->remarks.'--'. str_pad($order->id, 6, '0', STR_PAD_LEFT) . '-Paid-'.$request->mailCode
                    ]);
                }

                //////////////////////////////////////////////////// AccountHistoryGold //////////////////////////////////////

                            // If op1khalasGold > 0
                if (!empty($request->op1khalasGold) && $request->op1khalasGold > 0) {
                    AccountHistoryGold::create([
                        'party_id' => $request->party_id,
                        'gold' => $request->khalis,
                        'status' => 'Paid',
                        'remarks' => $request->remarks,
                        'user_id' => Auth::id()
                    ]);
                }

                // If op1GoldRecieved > 0
                if (!empty($request->op1GoldRecieved) && $request->op1GoldRecieved > 0) {
                    AccountHistoryGold::create([
                        'party_id' => $request->party_id,
                        'gold' => $request->op1GoldRecieved,
                        'status' => 'Received',
                        'remarks' => $request->remarks.'--'. str_pad($order->id, 6, '0', STR_PAD_LEFT) . '-Received-'.$request->mailCode,
                        'user_id' => Auth::id()
                    ]);
                }

                // If op1GoldPaid > 0
                if (!empty($request->op1GoldPaid) && $request->op1GoldPaid > 0) {
                    AccountHistoryGold::create([
                        'party_id' => $request->party_id,
                        'gold' => $request->op1GoldPaid,
                        'status' => 'Paid',
                        'remarks' => $request->remarks.'--'. str_pad($order->id, 6, '0', STR_PAD_LEFT) . '-Paid-'.$request->mailCode,
                        'user_id' => Auth::id()
                    ]);
                }

                //////////////////////////////////////////////AccountCash////////////////////////////////////////////////////////////
                    // ✅ CASH ENTRIES

                AccountCash::where('party_id', $request->party_id)->delete();

                if (!empty($request->op1mazdori) && $request->op1mazdori > 0) {
                    AccountCash::create([
                        'party_id' => $request->party_id,
                        'cash' => $request->op1mazdori,
                        'status' => 'Paid',
                        'remarks' => $request->remarks,
                    ]);
                }

                if (!empty($request->op1MazdooriRecieved) && $request->op1MazdooriRecieved > 0) {
                    AccountCash::create([
                        'party_id' => $request->party_id,
                        'cash' => $request->op1MazdooriRecieved,
                        'status' => 'Received',
                        'remarks' => $request->remarks.'--'. str_pad($order->id, 6, '0', STR_PAD_LEFT) . '-Paid-'.$request->mailCode,
                    ]);
                }

                if (!empty($request->op1MazdooriPaid) && $request->op1MazdooriPaid > 0) {
                    AccountCash::create([
                        'party_id' => $request->party_id,
                        'cash' => $request->op1MazdooriPaid,
                        'status' => 'Paid',
                        'remarks' => $request->remarks.'--'. str_pad($order->id, 6, '0', STR_PAD_LEFT) . '-Paid-'.$request->mailCode,
                    ]);
                }

                /////////////////////////////////////////AccountHistoryCash//////////////////////////////////////////////////////////////////////

                if (!empty($request->mazdoorie) && $request->mazdoorie > 0) {
                    AccountHistoryCash::create([
                        'party_id' => $request->party_id,
                        'cash' => $request->mazdoorie,
                        'status' => 'Paid',
                        'remarks' => 'Mazdoori Entry',
                        'user_id' => Auth::id(),
                    ]);
                }

                if (!empty($request->op1MazdooriRecieved) && $request->op1MazdooriRecieved > 0) {
                    AccountHistoryCash::create([
                        'party_id' => $request->party_id,
                        'cash' => $request->op1MazdooriRecieved,
                        'status' => 'Received',
                        'remarks' => 'Mazdoori Received from customer',
                        'user_id' => Auth::id(),
                    ]);
                }

                if (!empty($request->op1MazdooriPaid) && $request->op1MazdooriPaid > 0) {
                    AccountHistoryCash::create([
                        'party_id' => $request->party_id,
                        'cash' => $request->op1MazdooriPaid,
                        'status' => 'Paid',
                        'remarks' => 'Mazdoori Paid to customer',
                        'user_id' => Auth::id(),
                    ]);
                }


                ////////////////////////////////////////////////StockGold//////////////////////////////////////////////////////////////

                // StockGold::create([
                //     'gold' => $request->totalGold - $request->InOut,
                //     'status' => 'Paid',
                //     'remarks' => 'Gold added successfully'
                // ]);


                if (!empty($request->op1khalasGold) && $request->op1khalasGold > 0) {
                    StockGold::create([
                        'gold' => $request->khalis - $request->InOut,
                        'status' => 'Paid',
                        'remarks' => 'Khalas Gold Entry'
                    ]);
                }

                // If op1GoldRecieved > 0
                if (!empty($request->op1GoldRecieved) && $request->op1GoldRecieved > 0) {
                    StockGold::create([
                        'gold' => $request->op1GoldRecieved,
                        'status' => 'Received',
                        'remarks' => 'Gold Received from customer'
                    ]);
                }

                // If op1GoldPaid > 0
                if (!empty($request->op1GoldPaid) && $request->op1GoldPaid > 0) {
                    StockGold::create([
                        'gold' => $request->op1GoldPaid,
                        'status' => 'Paid',
                        'remarks' => 'Gold Paid to customer'
                    ]);
                }

                //////////////////////////////////////////////////////////StockCash////////////////////////////////////////////////////////

                if (!empty($request->op1MazdooriRecieved) && $request->op1MazdooriRecieved > 0) {
                    StockCash::create([
                        'cash' => $request->op1MazdooriRecieved,
                        'status' => 'Received',
                        'remarks' => 'Mazdoori Received from customer',
                    ]);
                }

                if (!empty($request->op1MazdooriPaid) && $request->op1MazdooriPaid > 0) {
                    StockCash::create([
                        'cash' => $request->op1MazdooriPaid,
                        'status' => 'Paid',
                        'remarks' => 'Mazdoori Paid to customer',
                    ]);
                }



            }

            if($request->selectOption == "op2"){

                $party = Party::with(['partyRegular', 'accountCashes', 'accountGolds'])
                    ->where('partyID', $request->party_id)
                    ->first();

                if ($party) {
                    $cashReceived = $party->accountCashes->where('status', 'Received')->sum('cash');
                    $cashPaid     = $party->accountCashes->where('status', 'Paid')->sum('cash');
                    $cashBalance  = $cashPaid - $cashReceived;

                    $goldReceived = $party->accountGolds->where('status', 'Received')->sum('gold');
                    $goldPaid     = $party->accountGolds->where('status', 'Paid')->sum('gold');
                    $goldBalance  = $goldPaid - $goldReceived;

                    $ordercheck = Order::find($order->id); // Make sure $order exists

                    if ($request->has('op2CashRecieved') && $request->op2CashRecieved > 0) {


                         if ($ordercheck) {
                            $ordercheck->goldIn      = $goldReceived ?? 0;
                            $ordercheck->goldOut     = $goldPaid ?? 0;
                            $ordercheck->cashIn      = $cashReceived ?? 0;
                            $ordercheck->cashOut     = $cashPaid ?? 0;

                            $ordercheck->goldInAfter  = $request->op2GoldRecieved ??0;
                            $ordercheck->goldOutAfter = $request->op2GoldRecieved ??0;
                            $ordercheck->cashInAfter  = $request->op2CashRecieved ?? 0;
                            $ordercheck->cashOutAfter = $request->op2cash ?? 0;
                            // $ordercheck->totalMazdoori = 0;
                            $ordercheck->totalMazdooriInGold =$request->op2MazdooriInGold;

                            $ordercheck->save();
                        }


                        $party->goldIn = $goldReceived;
                        $party->goldOut = $goldPaid;
                        $party->cashIn = $cashReceived;
                        $party->cashOut = $cashPaid;

                        $party->save();

                    }else{

                        if ($ordercheck) {
                            $ordercheck->goldIn      = $goldReceived ?? 0;
                            $ordercheck->goldOut     = $goldPaid ?? 0;
                            $ordercheck->cashIn      = $cashReceived ?? 0;
                            $ordercheck->cashOut     = $cashPaid ?? 0;

                            $ordercheck->goldInAfter  =  $request->op2GoldRecieved ?? 0;
                            $ordercheck->goldOutAfter = ($request->op2GoldPaid ?? 0) + ($request->op2TotalGoldwithMazdooriInGold) ;
                            $ordercheck->cashInAfter  = 0;
                            $ordercheck->cashOutAfter = 0;
                            // $ordercheck->totalMazdoori = 0;
                            $ordercheck->totalMazdooriInGold =$request->op2MazdooriInGold;

                            $ordercheck->save();
                        }


                        $party->goldIn = $goldReceived;
                        $party->goldOut = $goldPaid;
                        $party->cashIn = $cashReceived;
                        $party->cashOut = $cashPaid;

                        $party->save();




                    }

                   



                }


                if ($request->has('op2CashRecieved') && $request->op2CashRecieved > 0) {

                

                    // need to remove old entry agaist Party_id

                    AccountCash::where('party_id', $request->party_id)->delete();

                     if ($request->has('op2cash') && $request->op2cash > 0) {

                        AccountCash::create([
                            'party_id' => $request->party_id,
                            'cash' => $request->op2cash,
                            'status' => 'Paid',
                            'remarks' => 'Mazdoori Entry',
                        ]);
                    }

                    if ($request->has('op2CashRecieved') && $request->op2CashRecieved > 0) {

                        AccountCash::create([
                            'party_id' => $request->party_id,
                            'cash' => $request->op2CashRecieved,
                            'status' => 'Received',
                            'remarks' => 'Mazdoori Entry',
                        ]);
                    }

                //////////////////////////////////////AccountGold///////////////////////////////////////////////////////////

                    if ($request->has('op2GoldRecieved')) {

                        AccountGold::where('party_id', $request->party_id)->delete();

                        // need to remove old entry agaist Party_id

                        AccountGold::create([
                            'party_id' => $request->party_id,
                            'gold' => $request->op2GoldRecieved,
                            'status' => 'Received',
                            'remarks' => 'op2 gold Received',
                        ]);

                        AccountGold::create([
                            'party_id' => $request->party_id,
                            'gold' => $request->op2GoldRecieved,
                            'status' => 'Paid',
                            'remarks' => 'op2 gold  Paid',
                        ]);
                    }

                /////////////////////////////////////// AccountHistoryCash  ///////////////////////////////////

                    if (!empty($request->mazdoorie) && $request->mazdoorie > 0) {
                        AccountHistoryCash::create([
                            'party_id' => $request->party_id,
                            'cash' => $request->mazdoorie,
                            'status' => 'Paid',
                            'remarks' => 'op2mazdoorie paid',
                            'user_id' => Auth::id(),
                        ]);
                    }

                    if (!empty($request->op2cash) && $request->op2cash > 0) {
                        AccountHistoryCash::create([
                            'party_id' => $request->party_id,
                            'cash' => $request->op2cash,
                            'status' => 'Paid',
                            'remarks' => 'op2cash Paid ',
                            'user_id' => Auth::id(),
                        ]);
                    }

                    if (!empty($request->op2CashRecieved) && $request->op2CashRecieved > 0) {
                        AccountHistoryCash::create([
                            'party_id' => $request->party_id,
                            'cash' => $request->op2CashRecieved,
                            'status' => 'Received',
                            'remarks' => 'op2CashRecieved recived ',
                            'user_id' => Auth::id(),
                        ]);
                    }

                ///////////////////////////////////// AccountHistoryGold ////////////////////////////////////

                    if (!empty($request->khalis) && $request->khalis > 0) {
                        AccountHistoryGold::create([
                            'party_id' => $request->party_id,
                            'gold' => $request->khalis,
                            'status' => 'Paid',
                            'remarks' => 'Gold Paid to customer',
                            'user_id' => Auth::id()
                        ]);
                    }

                    if ($request->has('op2GoldRecieved')) {

                        // need to remove old entry agaist Party_id

                        AccountHistoryGold::create([
                            'party_id' => $request->party_id,
                            'gold' => $request->op2GoldRecieved,
                            'status' => 'Received',
                            'remarks' => 'op2 gold Received',
                            'user_id' => Auth::id()
                        ]);

                        AccountHistoryGold::create([
                            'party_id' => $request->party_id,
                            'gold' => $request->op2GoldRecieved,
                            'status' => 'Paid',
                            'remarks' => 'op2 gold  Paid',
                            'user_id' => Auth::id()
                        ]);
                    }

                ///////////////////////////////// stockGold  /////////////////////////////////////////

                    if (!empty($request->khalis) && $request->khalis > 0) {
                        StockGold::create([
                            'gold' => $request->khalis - $request->InOut,
                            'status' => 'Paid',
                            'remarks' => 'Khalas Gold Entry'
                        ]);
                    }
                    if (!empty($request->op2GoldRecieved) && $request->op2GoldRecieved > 0) {
                        StockGold::create([
                            'gold' => $request->op2GoldRecieved,
                            'status' => 'Received',
                            'remarks' => 'Received Gold Entry'
                        ]);
                    }

                //////////////////////////////  StockCash  //////////////////////////////////////////

                    if (!empty($request->op2CashRecieved) && $request->op2CashRecieved > 0) {
                        StockCash::create([
                            'cash' => $request->op2CashRecieved,
                            'status' => 'Received',
                            'remarks' => 'cash recived Received from customer',
                        ]);
                    }



                    
                } 


                elseif ($request->filled('op2CashRecieved') && $request->op2CashRecieved == 0 && $request->filled('op2GoldRecieved') && $request->op2GoldRecieved > 1) {

                    //clear data from  Acount cash related to $request->party_id 

                    AccountCash::where('party_id', $request->party_id)->delete();
                    ///////////////////////////////////// Account Gold ////////////      

                    AccountGold::where('party_id', $request->party_id)->delete();

                    if ($request->has('op2TotalGoldwithMazdooriInGold') && $request->op2TotalGoldwithMazdooriInGold > 0) {

                        // need to remove old entry agaist Party_id

                        AccountGold::create([
                            'party_id' => $request->party_id,
                            'gold' => $request->op2TotalGoldwithMazdooriInGold,
                            'status' => 'Paid',
                            'remarks' => 'op2 gold Paid',
                        ]);
                    }

                    if ($request->has('op2GoldRecieved') && $request->op2GoldRecieved > 0) {

                        // need to remove old entry agaist Party_id

                        AccountGold::create([
                            'party_id' => $request->party_id,
                            'gold' => $request->op2GoldRecieved,
                            'status' => 'Received',
                            'remarks' => 'op2 gold Received',
                        ]);
                    }

                    ////////////////////////////////////   AccountHistoryCash  /////////////////////////////////////////


                    if (!empty($request->mazdoorie) && $request->mazdoorie > 0) {
                        AccountHistoryCash::create([
                            'party_id' => $request->party_id,
                            'cash' => $request->mazdoorie,
                            'status' => 'Paid',
                            'remarks' => 'op2cash mazdoorie Paid ',
                            'user_id' => Auth::id(),
                        ]);
                    }

                    /////////////////////////////////////   AccountHistoryGold ///////////////////////////////////////

                    if (!empty($request->khalis) && $request->khalis > 0) {
                        AccountHistoryGold::create([
                            'party_id' => $request->party_id,
                            'gold' => $request->khalis,
                            'status' => 'Paid',
                            'remarks' => 'Gold Paid to customer',
                            'user_id' => Auth::id()
                        ]);
                    }

                    if (!empty($request->op2GoldRecieved) && $request->op2GoldRecieved > 0) {
                        AccountHistoryGold::create([
                            'party_id' => $request->party_id,
                            'gold' => $request->op2GoldRecieved,
                            'status' => 'Received',
                            'remarks' => 'Gold Received to customer',
                            'user_id' => Auth::id()
                        ]);
                    }

                ///////////////////////////////////  StockGold /////////////////////////////////////////////////// 

                    if (!empty($request->khalis) && $request->khalis > 0) {
                        StockGold::create([
                            'gold' => $request->khalis - $request->InOut,
                            'status' => 'Paid',
                            'remarks' => 'Khalas Gold Entry'
                        ]);
                    }
                    if (!empty($request->op2GoldRecieved) && $request->op2GoldRecieved > 0) {
                        StockGold::create([
                            'gold' => $request->op2GoldRecieved,
                            'status' => 'Received',
                            'remarks' => 'Received Gold Entry'
                        ]);
                    }

                } 
                else {


                    if ($request->has('op2TotalGoldwithMazdooriInGold') && $request->op2TotalGoldwithMazdooriInGold > 0) {

                        // need to remove old entry agaist Party_id

                        AccountGold::where('party_id', $request->party_id)->delete();

                        AccountGold::create([
                            'party_id' => $request->party_id,
                            'gold' => $request->op2TotalGoldwithMazdooriInGold,
                            'status' => 'Paid',
                            'remarks' => 'op2 paid Received',
                        ]);
                    }


                    ///////////////////////////////// AccountHistoryCash ////////////////////////////////////

                    if (!empty($request->mazdoorie) && $request->mazdoorie > 0) {
                        AccountHistoryCash::create([
                            'party_id' => $request->party_id,
                            'cash' => $request->mazdoorie,
                            'status' => 'Paid',
                            'remarks' => 'op2cash mazdoorie Paid ',
                            'user_id' => Auth::id(),
                        ]);
                    }

                    //////////////////////////////////////////////////  AccountHistoryGold  //////////////////////////

                    if (!empty($request->khalis) && $request->khalis > 0) {
                        AccountHistoryGold::create([
                            'party_id' => $request->party_id,
                            'gold' => $request->khalis,
                            'status' => 'Paid',
                            'remarks' => 'op2cash khalis Paid ',
                            'user_id' => Auth::id(),
                        ]);
                    }

                    //////////////////////////////////////// StockGold   ////////////////////////////////////////////////

                   if (!empty($request->khalis) && $request->khalis > 0) {
                        StockGold::create([
                            'gold' => $request->khalis - $request->InOut,
                            'status' => 'Paid',
                            'remarks' => 'Khalas Paid Gold Entry'
                        ]);
                    }


                    

                }

            }

            if($request->selectOption == "op3"){


                $party = Party::with(['partyRegular', 'accountCashes', 'accountGolds'])
                    ->where('partyID', $request->party_id)
                    ->first();

                if ($party) {
                    $cashReceived = $party->accountCashes->where('status', 'Received')->sum('cash');
                    $cashPaid     = $party->accountCashes->where('status', 'Paid')->sum('cash');
                    $cashBalance  = $cashPaid - $cashReceived;

                    $goldReceived = $party->accountGolds->where('status', 'Received')->sum('gold');
                    $goldPaid     = $party->accountGolds->where('status', 'Paid')->sum('gold');
                    $goldBalance  = $goldPaid - $goldReceived;

                    $ordercheck = Order::find($order->id); // Make sure $order exists

                    if ($ordercheck) {
                        $ordercheck->goldIn      = $goldReceived ?? 0;
                        $ordercheck->goldOut     = $goldPaid ?? 0;
                        $ordercheck->cashIn      = $cashReceived ?? 0;
                        $ordercheck->cashOut     = $cashPaid ?? 0;

                        $ordercheck->goldInAfter  = 0;
                        $ordercheck->goldOutAfter = 0;
                        $ordercheck->cashInAfter  = $request->op3CashRecieved ?? 0;
                        $ordercheck->cashOutAfter = ($request->op3CashPaid ?? 0) + ($request->op3totalCashwithMazdooriInCash ?? 0);

                        $ordercheck->totalGold  = 0;
                        $ordercheck->totalMazdooriInGold = 0;
                        $ordercheck->save();
                    }


                    $party->goldIn = $goldReceived;
                    $party->goldOut = $goldPaid;
                    $party->cashIn = $cashReceived;
                    $party->cashOut = $cashPaid;

                    $party->save();



                }


                    AccountGold::where('party_id', $request->party_id)->delete();

                    AccountCash::where('party_id', $request->party_id)->delete();


                     if ($request->has('op3totalCashwithMazdooriInCash') && $request->op3totalCashwithMazdooriInCash > 0) {
                        AccountCash::create([
                            'party_id' => $request->party_id,
                            'cash' => $request->op3totalCashwithMazdooriInCash,
                            'status' => 'Paid',
                            'remarks' => 'op3 cash Paid',
                        ]);
                    }

                    if ($request->has('op3CashRecieved') && $request->op3CashRecieved > 0) {
                        AccountCash::create([
                            'party_id' => $request->party_id,
                            'cash' => $request->op3CashRecieved,
                            'status' => 'Received',
                            'remarks' => 'op3 cash Paid',
                        ]);
                    }

                    if($request->has('op3CashPaid') && $request->op3CashPaid > 0){
                        AccountCash::create([
                            'party_id' => $request->party_id,
                            'cash' => $request->op3CashPaid,
                            'status' => 'Paid',
                            'remarks' => 'op3 cash Paid',
                        ]);

                    }



                    ///////////////////////////////// AccountHistoryCash ////////////////////////////////////

                    if (!empty($request->mazdoorie) && $request->mazdoorie > 0) {
                        AccountHistoryCash::create([
                            'party_id' => $request->party_id,
                            'cash' => $request->mazdoorie,
                            'status' => 'Paid',
                            'remarks' => 'op3 cash mazdoorie Paid ',
                            'user_id' => Auth::id(),
                        ]);
                    }

                    if (!empty($request->op3CashRecieved) && $request->op3CashRecieved > 0) {
                        AccountHistoryCash::create([
                            'party_id' => $request->party_id,
                            'cash' => $request->op3CashRecieved,
                            'status' => 'Received',
                            'remarks' => 'op3 cash op3CashRecieved Paid ',
                            'user_id' => Auth::id(),
                        ]);
                    }

                    if (!empty($request->op3CashPaid) && $request->op3CashPaid > 0) {
                        AccountHistoryCash::create([
                            'party_id' => $request->party_id,
                            'cash' => $request->op3CashPaid,
                            'status' => 'Paid',
                            'remarks' => 'op3 cash op3CashPaid Paid ',
                            'user_id' => Auth::id(),
                        ]);
                    }


                    //////////////////////////////////////////////////  AccountHistoryGold  //////////////////////////

                    if (!empty($request->khalis) && $request->khalis > 0) {
                        AccountHistoryGold::create([
                            'party_id' => $request->party_id,
                            'gold' => $request->khalis,
                            'status' => 'Paid',
                            'remarks' => 'op2cash khalis Paid ',
                            'user_id' => Auth::id(),
                        ]);
                    }

                    //////////////////////////////////////// StockGold   ////////////////////////////////////////////////

                   if (!empty($request->khalis) && $request->khalis > 0) {
                        StockGold::create([
                            'gold' => $request->khalis - $request->InOut,
                            'status' => 'Paid',
                            'remarks' => 'Khalas Paid Gold Entry'
                        ]);
                    }

                    //////////////////////////////////////// Stockcash  ////////////////////////////////////////////////

                   if (!empty($request->op3CashRecieved) && $request->op3CashRecieved > 0) {
                        StockCash::create([
                            'cash' => $request->op3CashRecieved,
                            'status' => 'Received',
                            'remarks' => 'Khalas Paid Received Gold Entry'
                        ]);
                    }
                    if (!empty($request->op3CashPaid) && $request->op3CashPaid > 0) { 
                        StockCash::create([
                            'cash' => $request->op3CashPaid,
                            'status' => 'Paid',
                            'remarks' => 'Khalas Paid Gold Entry'
                        ]);
                    }



                    




                        
          
                    


            }



            //commentt

            // // Insert into account_history_cashes
            // AccountHistoryCash::create([
            //     'party_id' => $request->party_id,
            //     'cash' => $request->mazdoorie,
            //     'status' => 'Paid',
            //     'remarks' => 'Payment received in cash',
            //     'user_id' => Auth::id()
            // ]);

            // // Insert into account_history_gold
            // AccountHistoryGold::create([
            //     'party_id' => $request->party_id,
            //     'gold' => $request->totalGold,
            //     'status' => 'Paid',
            //     'remarks' => 'Gold given to customer',
            //     'user_id' => Auth::id()
            // ]);

            // AccountGold::create([
            //     'party_id' =>$request->party_id,
            //     'gold' => $request->totalGold,
            //     'status' => 'Paid',
            //     'remarks' => $request->remarks,
            // ]);

            // AccountCash::create([
            //     'party_id' => $request->party_id,
            //     'cash' => $request->mazdoorie,
            //     'status' => 'Paid',
            //     'remarks' => $request->remarks,
            // ]);

            // comment end

            // Insert into stock_cashes table
            // StockCash::create([
            //     'cash' => $mazdoorie,
            //     'status' => 'Paid',
            //     'remarks' => 'Mazdoorie cash added successfully'
            // ]);

            DB::commit(); // ✅ Commit transaction

            return response()->json([
                'message' => 'Order created successfully & Party updated.',
                'order' => $order,
                'party' => $party,
                'order' =>$order->id,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Validation error.',
                'errors'  => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return  $e->getMessage();
            DB::rollBack();
            return response()->json([
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }


    public function getLastOrderInformation(){
        try {

            $lastOrder = Order::latest('id')->first();

            if (!$lastOrder) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No previous orders found'
                ], 404);
            }

            $partyId = $lastOrder->party_id;

            $totalOrders = Order::where('party_id', $partyId)->count();
            
            return response()->json([
                'status' => 'success',
                'last_order_id' => $lastOrder->id,
                'party_id' => $partyId,
                'total_orders_for_party' => $totalOrders
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}






