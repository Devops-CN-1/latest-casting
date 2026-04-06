<!DOCTYPE html>
<html lang="ur" dir="rtl">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Print</title>
    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
 
    html,
    body {
        font-family: 'Segoe UI', Tahoma, Arial, sans-serif;
        font-size: 10px;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
 
    .print-sheet {
        padding-top: 3cm;
        width: 210mm;
        height: 135mm;
        padding-left: 1cm !important;
        padding-right: 1cm !important;
    }
 
    .label {
        font-weight: 700;
        white-space: nowrap;
        visibility: hidden;
    }
 
    .header-table {
        width: 100%;
        table-layout: fixed;
    }
 
    .header-table td {
        width: 12.5%;
        height: 0.9cm;
        vertical-align: middle;
    }
 
        .header-table,
.content-table {
    width: 100%;
    table-layout: fixed;
}
 
    .content-table td {
        width: 30%;
        padding: 3px 25px;
    }
 
    .text-right {
        text-align: right;
    }
 
    .text-left {
        text-align: left;
    }
 
    /* .val {
        white-space: nowrap;
    }
 
    .val-ltr {
        direction: ltr;
        text-align: left;
        unicode-bidi: embed;
    } */
    .flex-row {
        display: flex;
        justify-content: space-between;
    }
    @page {
        size: 210mm 135mm;
        margin: 0;
    }
 
    @media print {
 
        html,
        body {
            margin: 0;
            padding: 0;
        }
 
        .print-sheet {
        padding-top: 4.5cm;
        width: 210mm;
        min-height: 135mm;
        height:auto;
        margin: 0 !important;  
        padding-left: 1cm !important;
        padding-right: 1cm !important;
        box-sizing: border-box;
        overflow: hidden;
    }
    }
    </style>
</head>
 
<body>
    @php
    /* تاریخ cell = date only (d/m/Y). وقت cell = time only (g:i:s A). */
    $raw = trim((string) ($data['currentDateTime'] ?? ''));
    $dateOnly = '';
    $timeOnly = '';
    if ($raw !== '' && strtoupper($raw) !== 'N/A') {
    try {
    $dt = \Carbon\Carbon::parse($raw);
    $dateOnly = $dt->format('d/m/Y');
    $timeOnly = $dt->format('g:i:s A');
    } catch (\Throwable $e) {
    if (preg_match('/^(.+?)\s+(\d{1,2}:\d{2}:\d{2}\s*(?:AM|PM))$/i', $raw, $m)) {
    $dateOnly = trim($m[1]);
    $timeOnly = trim($m[2]);
    } else {
    $dateOnly = $raw;
    $timeOnly = '';
    }
    }
    }
    @endphp
 
    <div class="print-sheet">
        <table class="header-table text-xs">
            <tbody>
                <tr>
                    <td class="label text-right">سیریل نمبر</td>
                    <td class="val text-left">{{ $data['serialNumber'] }}</td>
                    <td class="label text-right">آرڈر نمبر</td>
                    <td class="val text-left">{{ $data['lastPartyBills'] }}</td>
                    <td class="label text-right">تاریخ</td>
                    <td class="val text-left">{{ $dateOnly }}</td>
                    <td class="label text-right">وقت</td>
                    <td class="val val-ltr">{{ $timeOnly }}</td>
                </tr>
                <tr>
                    <td class="label text-right">ریٹ فی تولہ</td>
                    <td class="val text-left">{{ $data['tollaRate'] }}</td>
                    <td class="label text-right">ریٹ فی گرام</td>
                    <td class="val text-left">{{ $data['gramRate'] }}</td>
                    <td class="label text-right">ویسٹ فیس دس گرام</td>
                    <td class="val text-left">{{ $data['wasteRate'] }}</td>
                    <td class="label text-right">مزدوری فی گرام</td>
                    <td class="val text-left">0</td>
                </tr>
                <tr>
                    <td class="label text-right">نام و ایڈریس</td>
                    <td colspan="3" class="val text-left">{{ $data['partyName'] }}</td>
                    <td class="label text-right">پارٹی نمبر</td>
                    <td class="val text-left">{{ $data['party_id'] }}</td>
                    <td class="label text-right">کیش کوڈ</td>
                    <td class="val text-left">
                        ({{ $data['InOutCheck'] == 1 ? 'IN' : 'OUT' }})
                        {{ $data['mailCode'] }}
                        <span class="label">رتی</span>
                    </td>
                </tr>
            </tbody>
        </table>
 
        <div class="content">
            <table class="content-table">
                <tbody>
                    <tr>
                        <td>
                            <div class="flex-row">
                                <span>وزن کاسٹنگ</span>
                                <span>{{ $data['weightCastig'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span>سابقا خالص</span>
                                <span class="val-ltr">{{ $data['advance'] }}</span>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-row">
                                <span>واپسی کاسٹنگ</span>
                                <span>{{ $data['wapsiGold'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span>کل خالص</span>
                                <span class="val-ltr">{{ $data['totalKhalis'] }}</span>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-row">
                                <span>نیٹ وزن</span>
                                <span>{{ $data['netWeight'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span>خالص مزدوری</span>
                                <span>{{ $data['mazdoorie'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span>مزدوری</span>
                                <span>{{ $data['mazdoorie'] }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-row">
                                <span>ویسٹ</span>
                                <span>{{ $data['wasteCasted'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span>کل خالص</span>
                                <span class="val-ltr">{{ $data['totalKhalis'] }}</span>
                            </div>
                        </td>
                        <!-- <td>
                            <div class="flex-row">
                                <span>سابقا مزدوری</span>
                                <span>{{ $data['remainingMazdoori'] }}</span>
                            </div>
                        </td> -->
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-row">
                                <span>کل وزن</span>
                                <span>{{ $data['totalWeight'] }}</span>
                            </div>
                        </td>
 
                        <td>
                            <div class="flex-row">
                                <span>وصول خالص</span>
                                <span>{{ $data['GoldRecieved'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span>کل مزدوری</span>
                                <span>{{ $data['totalMazdoori'] }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-row">
                                <span>میل نکلا</span>
                                <span>{{ $data['totalWeightCasted'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span>بقایا خالص</span>
                                <span class="val-ltr">{{ $data['RemainingGold'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span>مزدوری کا سونا</span>
                                <span>{{ $data['mazdooriGold'] }}</span>
                            </div>
                        </td>
 
                        <!-- <td>
                            <div class="flex-row">
                                <span>پَٹھور</span>
                            </div>
                        </td> -->
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-row">
                                <span>خالص</span>
                                <span>{{ $data['khalis'] }}</span>
                            </div>
                        </td>
                        <td class="text-right"></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
 
</html>