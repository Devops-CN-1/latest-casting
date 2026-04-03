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
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
        $request->validate([
            'csv_file' => [
                'required',
                'file',
                'max:51200',
                function (string $attribute, mixed $value, \Closure $fail) {
                    if (! $value instanceof \Illuminate\Http\UploadedFile) {
                        return;
                    }
                    $ext = strtolower($value->getClientOriginalExtension());
                    if (! in_array($ext, ['csv', 'txt'], true)) {
                        $fail('The file must use extension .csv or .txt.');
                    }
                },
            ],
        ]);

        $file = $request->file('csv_file');

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
            $filePath = $file->getRealPath();
            if ($filePath === false || $filePath === '') {
                throw new \RuntimeException('Could not read the uploaded file. Try saving as CSV UTF-8 from Excel.');
            }
            set_time_limit(300);
            $message = $this->{$methodMap[$table]}($filePath);
            return redirect()->route('import.form', ['table' => $table])->with('success', $message);
        } catch (\Throwable $e) {
            return redirect()->route('import.form', ['table' => $table])->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    /**
     * Read CSV with BOM stripping, trimmed headers, and row/column alignment fixes
     * for Excel exports (leading blank column, UTF-8 BOM on first header).
     *
     * @return array<int, array<string, string>>
     */
    protected function parseCsvRowsAssociative(string $filePath): array
    {
        $raw = file_get_contents($filePath);
        if ($raw === false) {
            throw new \RuntimeException('Could not read CSV file.');
        }
        // UTF-16 LE/BE (Excel "Unicode Text" and some exports)
        if (str_starts_with($raw, "\xFF\xFE")) {
            $raw = mb_convert_encoding(substr($raw, 2), 'UTF-8', 'UTF-16LE');
        } elseif (str_starts_with($raw, "\xFE\xFF")) {
            $raw = mb_convert_encoding(substr($raw, 2), 'UTF-8', 'UTF-16BE');
        }
        $raw = preg_replace('/^\xEF\xBB\xBF/', '', $raw);
        $lines = preg_split('/\r\n|\r|\n/', $raw, -1, PREG_SPLIT_NO_EMPTY);
        if ($lines === [] || $lines === false) {
            return [];
        }
        $firstLine = $lines[0];
        $commaCols = str_getcsv($firstLine, ',');
        $tabCols = str_getcsv($firstLine, "\t");
        $semiCols = str_getcsv($firstLine, ';');
        $counts = [
            ',' => count($commaCols),
            "\t" => count($tabCols),
            ';' => count($semiCols),
        ];
        arsort($counts);
        $delimiter = array_key_first($counts);
        if ($counts[$delimiter] < 2) {
            $delimiter = ',';
        }
        $rows = array_map(fn (string $line) => str_getcsv($line, $delimiter), $lines);
        $header = array_shift($rows);
        $header = array_map('trim', $header);
        if (isset($header[0])) {
            $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);
        }
        while ($header !== [] && $header[0] === '') {
            array_shift($header);
        }
        while ($header !== [] && end($header) === '') {
            array_pop($header);
        }
        $hc = count($header);
        if ($hc === 0) {
            throw new \RuntimeException('CSV has no usable header row.');
        }

        $out = [];
        foreach ($rows as $row) {
            $row = array_map('trim', $row);
            if ($row === [] || (count($row) === 1 && $row[0] === '')) {
                continue;
            }
            while (count($row) > $hc && ($row[0] === '' || $row[0] === null)) {
                array_shift($row);
            }
            if (count($row) > $hc) {
                $row = array_slice($row, 0, $hc);
            } elseif (count($row) < $hc) {
                $row = array_pad($row, $hc, '');
            }
            $data = array_combine($header, $row);
            if ($data === false) {
                continue;
            }
            $out[] = $data;
        }

        return $out;
    }

    /**
     * SQL/Excel exports often write the literal "NULL" in cells; MySQL rejects that for decimal columns.
     */
    protected function isCsvNumericEmpty(mixed $value): bool
    {
        if ($value === null || $value === '') {
            return true;
        }
        if (!is_string($value)) {
            return false;
        }
        $t = trim($value);
        if ($t === '') {
            return true;
        }
        if (strcasecmp($t, 'null') === 0) {
            return true;
        }
        if (strcasecmp($t, 'n/a') === 0 || strcasecmp($t, '#n/a') === 0) {
            return true;
        }

        return false;
    }

    /**
     * Parse common SQL/Excel export datetime strings (e.g. "6/28/2021 13:18") for MySQL timestamps.
     */
    protected function parseCsvDateTime(?string $value): ?Carbon
    {
        if ($value === null || trim($value) === '') {
            return null;
        }
        $t = trim($value);
        if (strcasecmp($t, 'null') === 0) {
            return null;
        }

        $formats = [
            'n/j/Y G:i',
            'n/j/Y G:i:s',
            'n/j/Y H:i:s',
            'm/d/Y H:i',
            'm/d/Y H:i:s',
            'Y-m-d H:i:s',
            'Y-m-d H:i',
            'd/m/Y H:i',
            'd/m/Y H:i:s',
        ];

        foreach ($formats as $fmt) {
            try {
                $c = Carbon::createFromFormat($fmt, $t);
            } catch (\Throwable) {
                continue;
            }
            if ($c instanceof Carbon) {
                return $c;
            }
        }

        try {
            return Carbon::parse($t);
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Resolve DateOfEntry-style columns case-insensitively and return Y-m-d H:i:s for created_at/updated_at.
     *
     * @param  list<string>  $columnAliases  e.g. ['DateOfEntry', 'DateofEntry']
     */
    protected function importTimestampFromRow(array $data, array $columnAliases): ?string
    {
        $norm = [];
        foreach ($data as $k => $v) {
            $nk = strtolower(preg_replace('/[\s_\-]/', '', (string) $k));
            if (!array_key_exists($nk, $norm)) {
                $norm[$nk] = $v;
            }
        }

        foreach ($columnAliases as $alias) {
            $key = strtolower(preg_replace('/[\s_\-]/', '', $alias));
            if (!isset($norm[$key])) {
                continue;
            }
            $raw = trim((string) $norm[$key]);
            if ($raw === '' || strcasecmp($raw, 'null') === 0) {
                continue;
            }
            $parsed = $this->parseCsvDateTime($raw);
            if ($parsed !== null) {
                return $parsed->format('Y-m-d H:i:s');
            }
        }

        return null;
    }

    /**
     * @param  class-string<Model>  $modelClass
     */
    protected function importCreate(string $modelClass, array $attributes): Model
    {
        $model = new $modelClass();
        $model->forceFill($attributes);
        $model->save();

        return $model;
    }

    public function partyregular($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.PTY_Regular.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }
        $dataRows = $this->parseCsvRowsAssociative($filePath);
        foreach ($dataRows as $data) {
            if (!array_key_exists('PtyID', $data)) {
                throw new \RuntimeException(
                    'Missing column PtyID. Check for a blank first column in the header row, UTF-8 BOM issues, or wrong delimiter. Found: '
                    . implode(', ', array_keys($data))
                );
            }
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

        $dataRows = $this->parseCsvRowsAssociative($filePath);

        foreach ($dataRows as $data) {
            if (!array_key_exists('PtyID', $data)) {
                throw new \RuntimeException(
                    'Missing column PtyID. Use comma- or tab-separated columns, UTF-8 without a stray blank header column. Found: '
                    . implode(', ', array_keys($data))
                );
            }

            // Clean and cast numeric values
            $goldIn           = floatval(trim($data['Gold_IN']));
            $goldOut          = floatval(trim($data['Gold_OUT']));
            $cashIn           = floatval(trim($data['Cash_IN']));
            $cashOut          = floatval(trim($data['Cash_OUT']));
            $totalWasteCasted = floatval(trim($data['TotalWasteCasted']));
            $totalMazdoori    = floatval(trim($data['TotalMazdori']));

            // Map CSV type: 0 = regular, 1 = cash (store as text in DB)
            $typeRaw = trim($data['type'] ?? '');
            $type = ($typeRaw === '1') ? 'cash' : 'regular';

            // lastOrderDate is a MySQL DATE column; CSV often has m/d/Y H:i (e.g. 3/30/2026 18:59)
            $lastOrderAt = $this->importTimestampFromRow($data, ['LastOrderDate', 'lastOrderDate']);
            $lastOrderDate = $lastOrderAt !== null ? substr($lastOrderAt, 0, 10) : null;

            Party::updateOrCreate(
                ['partyID' => $data['PtyID']],
                [
                    'type'               => $type,
                    'goldIn'             => $goldIn,
                    'goldOut'            => $goldOut,
                    'cashIn'             => $cashIn,
                    'cashOut'            => $cashOut,
                    'totalWasteCasted'   => $totalWasteCasted,
                    'totalMazdoori'      => $totalMazdoori,
                    'lastOrderDate'      => $lastOrderDate,
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

        $dataRows = $this->parseCsvRowsAssociative($filePath);

        foreach ($dataRows as $data) {
            if (!array_key_exists('PtyID', $data)) {
                throw new \RuntimeException(
                    'Missing column PtyID. Use comma- or tab-separated columns. Found: '
                    . implode(', ', array_keys($data))
                );
            }

            $pcTs = $this->importTimestampFromRow($data, ['timeOfaction', 'timeOfAction', 'DateOfEntry', 'DateofEntry'])
                ?? now();

            Model::unguarded(function () use ($data, $pcTs) {
                PartyCash::updateOrCreate(
                    ['partyID' => intval(trim($data['PtyID']))],
                    [
                        'status' => intval(trim($data['status'] ?? '0')),
                        'created_at' => $pcTs,
                        'updated_at' => $pcTs,
                    ]
                );
            });
        }

        return 'PartyCash CSV imported successfully!';
    }

    public function accountcash($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.Account_Cash.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        $dataRows = $this->parseCsvRowsAssociative($filePath);

        $statusMap = [
            'c' => 'Received',
            'd' => 'Paid',
        ];

        foreach ($dataRows as $data) {
            if (!array_key_exists('PtyID', $data)) {
                throw new \RuntimeException(
                    'Missing column PtyID. Use comma- or tab-separated columns. Found: '
                    . implode(', ', array_keys($data))
                );
            }

            $status = $statusMap[strtolower(trim($data['status'] ?? ''))] ?? 'Unknown';

            $acTs = $this->importTimestampFromRow($data, ['DateOfEntry', 'DateofEntry', 'dateofentry']) ?? now();

            $this->importCreate(AccountCash::class, [
                'party_id'   => intval(trim($data['PtyID'])),
                'cash'       => floatval(trim($data['cash'] ?? '0')),
                'status'     => $status,
                'remarks'    => trim($data['remarks'] ?? ''),
                'created_at' => $acTs,
                'updated_at' => $acTs,
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

        $dataRows = $this->parseCsvRowsAssociative($filePath);

        foreach ($dataRows as $data) {
            if (!array_key_exists('PtyID', $data)) {
                throw new \RuntimeException(
                    'Missing column PtyID. Use comma- or tab-separated columns. Found: '
                    . implode(', ', array_keys($data))
                );
            }

            $status = $statusMap[strtolower(trim($data['status'] ?? ''))] ?? 'Unknown';

            $agTs = $this->importTimestampFromRow($data, ['DateOfEntry', 'DateofEntry', 'dateofentry']) ?? now();

            $this->importCreate(AccountGold::class, [
                'party_id'   => intval(trim($data['PtyID'])),
                'gold'       => floatval(trim($data['gold'] ?? '0')),
                'status'     => $status,
                'remarks'    => trim($data['remarks'] ?? ''),
                'created_at' => $agTs,
                'updated_at' => $agTs,
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

        $dataRows = $this->parseCsvRowsAssociative($filePath);

        $statusMap = [
            'c' => 'Received',
            'd' => 'Paid',
        ];

        foreach ($dataRows as $data) {
            if (!array_key_exists('PtyID', $data)) {
                throw new \RuntimeException(
                    'Missing column PtyID. Use comma- or tab-separated columns. Found: '
                    . implode(', ', array_keys($data))
                );
            }

            $statusCode = strtolower(trim($data['status'] ?? ''));
            $status = $statusMap[$statusCode] ?? 'Unknown';

            $ahcTs = $this->importTimestampFromRow($data, ['DateOfEntry', 'DateofEntry', 'dateofentry']) ?? now();

            $this->importCreate(AccountHistoryCash::class, [
                'party_id'   => intval(trim($data['PtyID'])),
                'cash'       => floatval(trim($data['cash'] ?? '0')),
                'status'     => $status,
                'remarks'    => trim($data['remarks'] ?? ''),
                'user_id'    => 1,
                'created_at' => $ahcTs,
                'updated_at' => $ahcTs,
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

        $dataRows = $this->parseCsvRowsAssociative($filePath);

        $statusMap = [
            'a' => 'Received',
            'b' => 'Paid',
        ];

        foreach ($dataRows as $data) {
            if (!array_key_exists('PtyID', $data)) {
                throw new \RuntimeException(
                    'Missing column PtyID. Use comma- or tab-separated columns. Found: '
                    . implode(', ', array_keys($data))
                );
            }

            $statusCode = strtolower(trim($data['status'] ?? ''));
            $status = $statusMap[$statusCode] ?? 'Unknown';

            $ahgTs = $this->importTimestampFromRow($data, ['DateOfEntry', 'DateofEntry', 'dateofentry']) ?? now();

            $this->importCreate(AccountHistoryGold::class, [
                'party_id'   => intval(trim($data['PtyID'])),
                'gold'       => floatval(trim($data['gold'] ?? '0')),
                'status'     => $status,
                'remarks'    => trim($data['remarks'] ?? ''),
                'user_id'    => 1,
                'created_at' => $ahgTs,
                'updated_at' => $ahgTs,
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

            $amTs = $this->importTimestampFromRow($data, ['DateofEntry', 'DateOfEntry', 'dateofentry']) ?? now();

            $this->importCreate(AccountMain::class, [
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
                'created_at'         => $amTs,
                'updated_at'         => $amTs,
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

        $dataRows = $this->parseCsvRowsAssociative($filePath);

        foreach ($dataRows as $data) {
            $d = array_change_key_case($data, CASE_LOWER);
            if (!array_key_exists('cash', $d)) {
                throw new \RuntimeException(
                    'Missing column cash. Use comma- or tab-separated columns. Found: '
                    . implode(', ', array_keys($data))
                );
            }

            $ecTs = $this->importTimestampFromRow($data, ['DateOfEntry', 'DateofEntry', 'dateofentry']) ?? now();

            $this->importCreate(ExpenseCash::class, [
                'cash'       => floatval(trim($d['cash'])),
                'remarks'    => trim($d['remarks'] ?? ''),
                'created_at' => $ecTs,
                'updated_at' => $ecTs,
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

            $egTs = $this->importTimestampFromRow($data, ['DateofEntry', 'DateOfEntry', 'dateofentry']) ?? now();

            $this->importCreate(ExpenseGold::class, [
                'gold'       => floatval(trim($data['gold'])),
                'remarks'    => trim($data['Remarks']),
                'created_at' => $egTs,
                'updated_at' => $egTs,
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

        $dataRows = $this->parseCsvRowsAssociative($filePath);

        foreach ($dataRows as $data) {
            if (!array_key_exists('Serial', $data)) {
                throw new \RuntimeException(
                    'Missing column Serial. Use comma- or tab-separated columns. Found: '
                    . implode(', ', array_keys($data))
                );
            }

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
                'TotalKhalis','RemainingMazdori','WapsiGold','CastingWeight',
                'InOutCheck','InOut','SelectOption',
            ];

            foreach ($numericFields as $field) {
                if (!isset($data[$field]) || $this->isCsvNumericEmpty($data[$field])) {
                    $data[$field] = 0;
                }
            }

            $orderId = intval($data['Serial']);
            if ($orderId <= 0) {
                continue;
            }

            $orderTs = $this->importTimestampFromRow($data, ['DateOfCompletion', 'DateOfEntry', 'DateofEntry']) ?? now();

            // ------------------------------------------
            // 🟦 Upsert by legacy Serial → id (safe to re-run import)
            // ------------------------------------------
            Model::unguarded(function () use ($orderId, $data, $orderTs) {
                Order::updateOrCreate(
                    ['id' => $orderId],
                    [
                'id'                        => $orderId,
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

                'created_at'                => $orderTs,
                'updated_at'                => $orderTs,
                    ]
                );
            });
        }

        return 'Orders imported successfully!';
    }

    public function importStockCash($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.Stock_Cash.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        $dataRows = $this->parseCsvRowsAssociative($filePath);

        if ($dataRows === []) {
            throw new \RuntimeException(
                'No data rows after the header. Check the file is UTF-8 (Excel: Save As → CSV UTF-8), '
                . 'and that the first row is headers including Cash, status, DateOfEntry.'
            );
        }

        $statusMap = [
            'a' => 'Received',
            'b' => 'Paid',
            'c' => 'Received',
            'd' => 'Paid',
        ];

        foreach ($dataRows as $data) {
            $d = array_change_key_case($data, CASE_LOWER);
            if (!array_key_exists('cash', $d)) {
                throw new \RuntimeException(
                    'Missing column Cash. Use comma- or tab-separated columns. Found: '
                    . implode(', ', array_keys($data))
                );
            }

            $cash = $this->isCsvNumericEmpty($d['cash']) ? 0.0 : floatval(trim((string) $d['cash']));

            $statusCode = trim((string) ($d['status'] ?? ''));
            $status = $statusCode !== ''
                ? ($statusMap[strtolower($statusCode)] ?? $statusCode)
                : null;

            $scTs = $this->importTimestampFromRow($data, ['DateOfEntry', 'DateofEntry', 'dateofentry']) ?? now();

            $this->importCreate(StockCash::class, [
                'cash'       => $cash,
                'status'     => $status,
                'remarks'    => isset($d['remarks']) && $d['remarks'] !== '' ? $d['remarks'] : null,
                'created_at' => $scTs,
                'updated_at' => $scTs,
            ]);
        }

        return 'Stock Cash CSV imported successfully (' . count($dataRows) . ' rows).';
    }

    public function importStockGold($filePath = null)
    {
        $filePath = $filePath ?? base_path('dbo.Stock_Gold.csv');
        if (!file_exists($filePath)) {
            throw new \RuntimeException('CSV file not found.');
        }

        $dataRows = $this->parseCsvRowsAssociative($filePath);

        $statusMap = [
            'a' => 'Received',
            'b' => 'Paid',
        ];

        foreach ($dataRows as $data) {
            $d = array_change_key_case($data, CASE_LOWER);
            if (!array_key_exists('gold', $d)) {
                throw new \RuntimeException(
                    'Missing column Gold. Use comma- or tab-separated columns. Found: '
                    . implode(', ', array_keys($data))
                );
            }

            $gold = $this->isCsvNumericEmpty($d['gold']) ? 0.0 : floatval(trim((string) $d['gold']));

            $statusCode = trim((string) ($d['status'] ?? ''));
            $status = $statusCode !== ''
                ? ($statusMap[strtolower($statusCode)] ?? $statusCode)
                : null;

            $sgTs = $this->importTimestampFromRow($data, ['DateOfEntry', 'DateofEntry', 'dateofentry']) ?? now();

            $this->importCreate(StockGold::class, [
                'gold'       => $gold,
                'status'     => $status,
                'remarks'    => isset($d['remarks']) && $d['remarks'] !== '' ? $d['remarks'] : null,
                'created_at' => $sgTs,
                'updated_at' => $sgTs,
            ]);
        }

        return 'Stock Gold CSV imported successfully!';
    }
}
