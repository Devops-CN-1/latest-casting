<?php

namespace App\Http\Controllers;

use App\Models\PartyRegular;
use App\Models\Party;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PartyCash;
use App\Models\AccountCash;
use App\Models\AccountGold;
use App\Models\AccountHistoryCash;
use App\Models\AccountHistoryGold;
use App\Models\AccountMain;
use App\Models\ExpenseCash;
use App\Models\ExpenseGold;
use App\Models\StockCash;
use App\Models\StockGold;
use App\Models\Order;

class ImportDbDataController extends Controller
{
    protected static $importTables = [
        'party-regular'       => ['title' => 'Party Regular', 'expectedFile' => 'dbo.PTY_Regular.csv'],
        'parties'             => ['title' => 'Parties', 'expectedFile' => 'dbo.Parties.csv'],
        'party-cash'          => ['title' => 'Party Cash', 'expectedFile' => 'dbo.PTY_cash.csv'],
        'account-cash'        => ['title' => 'Account Cash', 'expectedFile' => 'dbo.Account_Cash.csv'],
        'account-gold'        => ['title' => 'Account Gold', 'expectedFile' => 'dbo.Account_Gold.csv'],
        'account-history-cash'=> ['title' => 'Account History Cash', 'expectedFile' => 'dbo.Account_History_Cash.csv'],
        'account-history-gold'=> ['title' => 'Account History Gold', 'expectedFile' => 'dbo.Account_History_Gold.csv'],
        'account-main'        => ['title' => 'Account Main', 'expectedFile' => 'dbo.AccountsMain.csv'],
        'expense-cash'        => ['title' => 'Expense Cash', 'expectedFile' => 'dbo.Expense_Cash.csv'],
        'expense-gold'        => ['title' => 'Expense Gold', 'expectedFile' => 'dbo.Expense_Gold.csv'],
        'orders'              => ['title' => 'Orders', 'expectedFile' => 'dbo.OrderComplete.csv'],
        'stock-cash'          => ['title' => 'Stock Cash', 'expectedFile' => 'dbo.Stock_Cash.csv'],
        'stock-gold'          => ['title' => 'Stock Gold', 'expectedFile' => 'dbo.Stock_Gold.csv'],
    ];

    public function index()
    {
        return view('import.index');
    }

    public function showForm(string $table)
    {
        if (!isset(self::$importTables[$table])) {
            abort(404, 'Import table not found.');
        }
        $config = self::$importTables[$table];
        $uploadRoute = route('import.upload', ['table' => $table]);
        return view('import.upload', [
            'title'        => $config['title'],
            'expectedFile' => $config['expectedFile'],
            'uploadRoute'  => $uploadRoute,
        ]);
    }

    public function upload(Request $request, string $table)
    {
        $request->validate(['csv_file' => 'required|file|mimes:csv,txt|max:10240']);
        $file = $request->file('csv_file');
        $filePath = $file->getRealPath();

        $methodMap = [
            'party-regular'        => 'partyregular',
            'parties'              => 'party',
            'party-cash'           => 'partycash',
            'account-cash'         => 'accountcash',
            'account-gold'         => 'accountgold',
            'account-history-cash' => 'accounthistorycash',
            'account-history-gold' => 'accounthistorygold',
            'account-main'         => 'accountmain',
            'expense-cash'         => 'expensecash',
            'expense-gold'         => 'expensegold',
            'orders'               => 'importorders',
            'stock-cash'           => 'importStockCash',
            'stock-gold'           => 'importStockGold',
        ];
        if (!isset($methodMap[$table])) {
            return redirect()->route('import.index')->with('error', 'Invalid table.');
        }
        try {
            $message = $this->{$methodMap[$table]}($filePath);
            return redirect()->route('import.form', ['table' => $table])->with('success', $message);
        } catch (\Throwable $e) {
            return redirect()->route('import.form', ['table' => $table])->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    public function partyregular($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.PTY_Regular.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }
        $rows = array_map('str_getcsv', file($filePath));
        $header = array_shift($rows);
        foreach ($rows as $row) {
            $data = array_combine($header, $row);
            PartyRegular::updateOrCreate(
                ['partyID' => $data['PtyID']],
                [
                    'partyName'            => $data['PtyName'],
                    'businessName'         => $data['BizName'],
                    'address'              => $data['Address'],
                    'phone'                => trim($data['fone']),
                    'totalOrders'          => $data['TotalOrders'],
                    'wasteDiscount'        => $data['WasteDiscount'],
                    'mazdoriDiscount'      => $data['MazdoriDiscount'],
                    'wasteDiscount16'      => $data['WasteDiscount16'],
                    'mazdooriDiscount16'   => $data['MazdoriDiscount16'],
                ]
            );
        }
        return 'Party Regular CSV imported successfully!';
    }

    public function party($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.Parties.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        $rows = array_map('str_getcsv', file($filePath));
        $header = array_shift($rows); // remove header

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            // Clean and cast numeric values
            $goldIn           = floatval(trim($data['Gold_IN']));
            $goldOut          = floatval(trim($data['Gold_OUT']));
            $cashIn           = floatval(trim($data['Cash_IN']));
            $cashOut          = floatval(trim($data['Cash_OUT']));
            $totalWasteCasted = floatval(trim($data['TotalWasteCasted']));
            $totalMazdoori    = floatval(trim($data['TotalMazdori']));

            Party::updateOrCreate(
                ['partyID' => $data['PtyID']],
                [
                    'type'               => intval(trim($data['type'])),
                    'goldIn'             => $goldIn,
                    'goldOut'            => $goldOut,
                    'cashIn'             => $cashIn,
                    'cashOut'            => $cashOut,
                    'totalWasteCasted'   => $totalWasteCasted,
                    'totalMazdoori'      => $totalMazdoori,
                    'lastOrderDate'      => $data['LastOrderDate'],
                    'IsActive'           => 1,
                    'created_by'           => 1,
                ]
            );
        }

        return 'Parties CSV imported successfully!';
    }

    public function partycash($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.PTY_cash.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        $rows = array_map('str_getcsv', file($filePath));
        $header = array_shift($rows); // remove header row

        foreach ($rows as $row) {
            $data = array_combine($header, $row);



             PartyCash::updateOrCreate(
                ['partyID' => intval(trim($data['PtyID']))], // store PtyID as partyID
                [
                    'status' => intval(trim($data['status'])),
                    'created_at' => trim($data['timeOfaction']),
                    'updated_at' => trim($data['timeOfaction']),
                ]
            );
        }

        return 'PartyCash CSV imported successfully!';
    }

    public function accountcash($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.Account_Cash.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        // Read CSV
        $rows = array_map('str_getcsv', file($filePath));
        $header = array_shift($rows); // remove header row

        $statusMap = [
            'c' => 'Received',
            'd' => 'Paid',
        ];

        foreach ($rows as $row) {
            $data = array_combine($header, $row);
              $status = $statusMap[strtolower(trim($data['status']))] ?? 'Unknown';

            // Insert into database
            AccountCash::create([
                'party_id'   => intval(trim($data['PtyID'])),     // map PtyID → party_id
                'cash'       => floatval(trim($data['cash'])),    // numeric
                'status'     => $status,
                'remarks'    => trim($data['remarks']),
                'created_at' => trim($data['DateOfEntry']),
                'updated_at' => trim($data['DateOfEntry']),
            ]);
        }

        return 'Account Cash CSV imported successfully!';
    }

    public function accountgold($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.Account_Gold.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        // Status mapping
        $statusMap = [
            'a' => 'Received',
            'b' => 'Paid',
        ];

        $rows = array_map('str_getcsv', file($filePath));
        $header = array_shift($rows); // remove header

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            // Map status
            $status = $statusMap[strtolower(trim($data['status']))] ?? 'Unknown';

            AccountGold::create([
                'party_id'   => intval(trim($data['PtyID'])),
                'gold'       => floatval(trim($data['gold'])),
                'status'     => $status,
                'remarks'    => trim($data['remarks']),
                'created_at' => trim($data['DateOfEntry']),
                'updated_at' => trim($data['DateOfEntry']),
            ]);
        }

        return 'Account Gold CSV imported successfully!';
    }

    public function accounthistorycash($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.Account_History_Cash.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        // CSV to array
        $rows = array_map('str_getcsv', file($filePath));
        $header = array_shift($rows);

        // Status mapping
        $statusMap = [
            'c' => 'Received',
            'd' => 'Paid',
        ];

        foreach ($rows as $row) {

            $data = array_combine($header, $row);

            $statusCode = strtolower(trim($data['status']));
            $status = $statusMap[$statusCode] ?? 'Unknown';

            AccountHistoryCash::create([
                'party_id'   => intval(trim($data['PtyID'])),
                'cash'       => floatval(trim($data['cash'])),
                'status'     => $status,
                'remarks'    => trim($data['remarks']),
                'user_id'    => 1, // change if needed
                'created_at' => trim($data['DateOfEntry']),
                'updated_at' => trim($data['DateOfEntry']),
            ]);
        }

        return 'Account History Cash imported successfully!';
    }

    public function accounthistorygold($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.Account_History_Gold.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        // Read CSV
        $rows = array_map('str_getcsv', file($filePath));
        $header = array_shift($rows);

        // Status mapping
        $statusMap = [
            'a' => 'Received',
            'b' => 'Paid',
        ];

        foreach ($rows as $row) {

            $data = array_combine($header, $row);

            $statusCode = strtolower(trim($data['status']));
            $status = $statusMap[$statusCode] ?? 'Unknown';

            AccountHistoryGold::create([
                'party_id'   => intval(trim($data['PtyID'])),
                'gold'       => floatval(trim($data['gold'])),
                'status'     => $status,
                'remarks'    => trim($data['remarks']),
                'user_id'    => 1, // or Auth::id() if logged in
                'created_at' => trim($data['DateOfEntry']),
                'updated_at' => trim($data['DateOfEntry']),
            ]);
        }

        return 'Account History Gold imported successfully!';
    }

    public function accountmain($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.AccountsMain.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        // Read CSV
        $rows = array_map('str_getcsv', file($filePath));
        $header = array_shift($rows);

        // Status mappings
        $statusGold = [
            'a' => 'Received',
            'b' => 'Paid',
        ];

        $statusCash = [
            'c' => 'Received',
            'd' => 'Paid',
        ];

        foreach ($rows as $row) {

            $data = array_combine($header, $row);

            $goldStatusCode = strtolower(trim($data['GoldStatus']));
            $cashStatusCode = strtolower(trim($data['CashStatus']));

            $goldStatus = $statusGold[$goldStatusCode] ?? null;
            $cashStatus = $statusCash[$cashStatusCode] ?? null;

            AccountMain::create([
                'partyID'            => intval(trim($data['PtyID'])),
                'recievedGoldLast'   => floatval(trim($data['RGoldLast'])),
                'paidGoldLast'       => floatval(trim($data['PGoldLast'])),
                'recievedCashLast'   => floatval(trim($data['RCashLast'])),
                'paidCashLast'       => floatval(trim($data['PCashLast'])),
                'goldRate'           => floatval(trim($data['GoldRate'])),
                'gold'               => floatval(trim($data['Gold'])),
                'goldStatus'         => $goldStatus,
                'cash'               => floatval(trim($data['Cash'])),
                'cashStatus'         => $cashStatus,
                'hawala'             => trim($data['Hawala']),
                'addGold'            => floatval(trim($data['AddGold'])),
                'created_at'         => trim($data['DateofEntry']),
                'updated_at'         => trim($data['DateofEntry']),
            ]);
        }

        return 'Account Main imported successfully!';
    }

    public function expensecash($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.Expense_Cash.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        // Read file
        $rows = array_map('str_getcsv', file($filePath));
        $header = array_shift($rows);

        foreach ($rows as $row) {

            $data = array_combine($header, $row);

            ExpenseCash::create([
                'cash'       => floatval(trim($data['cash'])),
                'remarks'    => trim($data['Remarks']),
                'created_at' => trim($data['DateofEntry']),
                'updated_at' => trim($data['DateofEntry']),
            ]);
        }

        return 'Expense Cash imported successfully!';
    }

    public function expensegold($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.Expense_Gold.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        // Read CSV
        $rows = array_map('str_getcsv', file($filePath));
        $header = array_shift($rows); // Remove header row

        foreach ($rows as $row) {

            $data = array_combine($header, $row);

            ExpenseGold::create([
                'gold'       => floatval(trim($data['gold'])),
                'remarks'    => trim($data['Remarks']),
                'created_at' => trim($data['DateofEntry']),
                'updated_at' => trim($data['DateofEntry']),
            ]);
        }

        return 'Expense Gold imported successfully!';
    }

    public function importorders($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.OrderComplete.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        $rows = array_map('str_getcsv', file($filePath));
        $header = array_shift($rows);

        foreach ($rows as $row) {

            $data = array_combine($header, $row);

            // ------------------------------------------
            // 🔵 Convert ALL empty numeric values to 0
            // ------------------------------------------
            $numericFields = [
                'Weight_Ready','MazdoriRate','WasteRate','TollaRate',
                'Gold_IN','Gold_Out','Cash_IN','cash_out',
                'WastedCasted','Mazdoori','Piece',
                'TotalGold','TotalMaz','TotalMazInGold','TotalGoldInCash',
                'Gold_In_After','Gold_out_After','Cash_In_After','Cash_Out_After',
                'Opt1GoldRecieved','Opt1MazRecieved','Opt1GoldPaid','Opt1MazPaid',
                'Opt1RemainingGold','Opt1RemainingCash',
                'Opt2GoldRecieved','Opt2GoldPaid','Opt2RemainingGold',
                'Opt2CashRecieved','Opt2CashPaid','Opt2RemainingCash',
                'Opt3CashRecieved','Opt3CashPaid','Opt3RemainingCash',
                'TotalWeight','TotalWasteCasted','Khalis','Advance',
                'TotalKhalis','RemainingMazdori','WapsiGold','CastingWeight'
            ];

            foreach ($numericFields as $field) {
                if (!isset($data[$field]) || $data[$field] === '') {
                    $data[$field] = 0;
                }
            }

            // ------------------------------------------
            // 🟦 Import into Orders table
            // ------------------------------------------
            Order::create([
                'id'                        => intval($data['Serial']),
                'party_id'                  => intval($data['PtyID']),
                'created_by'                => 1,

                'weightReady'               => $data['Weight_Ready'],
                'mailCode'                  => $data['MailCode'],
                'mazdoriRate'               => $data['MazdoriRate'],
                'wasteRate'                 => $data['WasteRate'],
                'tollaRate'                 => $data['TollaRate'],

                'goldIN'                    => $data['Gold_IN'],
                'goldOut'                   => $data['Gold_Out'],
                'cashIn'                    => $data['Cash_IN'],
                'cashOut'                   => $data['cash_out'],

                'wasteCasted'               => $data['WastedCasted'],
                'mazdoorie'                 => $data['Mazdoori'],

                'InOutCheck'                => $data['InOutCheck'],
                'InOut'                     => $data['InOut'],
                'Piece'                     => $data['Piece'],

                'remarks'                   => $data['Remarks'],
                'selectOption'              => $data['SelectOption'],

                'totalGold'                 => $data['TotalGold'],
                'totalMazdoori'             => $data['TotalMaz'],
                'totalMazdooriInGold'       => $data['TotalMazInGold'],
                'totalMazdooriInCash'       => $data['TotalGoldInCash'],

                'goldInAfter'               => $data['Gold_In_After'],
                'goldOutAfter'              => $data['Gold_out_After'],
                'cashInAfter'               => $data['Cash_In_After'],
                'cashOutAfter'              => $data['Cash_Out_After'],

                // Option 1
                'op1GoldRecieved'           => $data['Opt1GoldRecieved'],
                'op1MazdooriRecieved'       => $data['Opt1MazRecieved'],
                'op1GoldPaid'               => $data['Opt1GoldPaid'],
                'op1MazdooriPaid'           => $data['Opt1MazPaid'],
                'op1RemainingGold'          => $data['Opt1RemainingGold'],
                'op1RemainingCash'          => $data['Opt1RemainingCash'],

                // Option 2
                'op2GoldRecieved'           => $data['Opt2GoldRecieved'],
                'op2GoldPaid'               => $data['Opt2GoldPaid'],
                'op2RemainingGold'          => $data['Opt2RemainingGold'],
                'op2CashRecieved'           => $data['Opt2CashRecieved'],
                'op2CashPaid'               => $data['Opt2CashPaid'],
                'op2RemainingCash'          => $data['Opt2RemainingCash'],

                // Option 3
                'op3CashRecieved'           => $data['Opt3CashRecieved'],
                'op3CashPaid'               => $data['Opt3CashPaid'],
                'op3RemainingCash'          => $data['Opt3RemainingCash'],

                'totalWeight'               => $data['TotalWeight'],
                'totalWeightCasted'         => $data['TotalWasteCasted'],
                'khalis'                    => $data['Khalis'],
                'advance'                   => $data['Advance'],
                'totalKhalis'               => $data['TotalKhalis'],
                'remainingMazdoori'         => $data['RemainingMazdori'],
                'wapsiGold'                 => $data['WapsiGold'],
                'castingWeight'             => $data['CastingWeight'],

                'created_at'                => $data['DateOfCompletion'],
                'updated_at'                => $data['DateOfCompletion'],
            ]);
        }

        return 'Orders imported successfully!';
    }

    public function importStockCash($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.Stock_Cash.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        $rows = array_map('str_getcsv', file($filePath));
        $header = array_shift($rows); // remove header row

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            // Convert empty cash values to 0
            $cash = isset($data['Cash']) && $data['Cash'] !== '' ? $data['Cash'] : 0;

            // Map status codes
            $statusMap = [
                'a' => 'Received',
                'b' => 'Paid',
                'c' => 'Received', // or keep 'c' if special meaning
                'd' => 'Paid',     // or keep 'd' if special meaning
            ];

            $status = isset($data['status']) ? ($statusMap[$data['status']] ?? $data['status']) : null;

            StockCash::create([
                'cash'       => $cash,
                'status'     => $status,
                'remarks'    => $data['remarks'] ?? null,
                'created_at' => $data['DateOfEntry'] ?? now(),
                'updated_at' => $data['DateOfEntry'] ?? now(),
            ]);
        }

        return 'Stock Cash CSV imported successfully!';
    }

    public function importStockGold($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.Stock_Gold.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        $rows = array_map('str_getcsv', file($filePath));
        $header = array_shift($rows); // remove header row

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            // Convert empty gold values to 0
            $gold = isset($data['Gold']) && $data['Gold'] !== '' ? $data['Gold'] : 0;

            // Map status codes
            $statusMap = [
                'a' => 'Received',
                'b' => 'Paid',
            ];
            $status = isset($data['status']) ? ($statusMap[$data['status']] ?? $data['status']) : null;

            StockGold::create([
                'gold'       => $gold,
                'status'     => $status,
                'remarks'    => $data['remarks'] ?? null,
                'created_at' => $data['DateOfEntry'] ?? now(),
                'updated_at' => $data['DateOfEntry'] ?? now(),
            ]);
        }

        return 'Stock Gold CSV imported successfully!';
    }
}
