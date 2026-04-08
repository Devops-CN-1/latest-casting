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
        font-size: 12px;
        font-weight: bold;
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
.content-table {
        border-collapse: collapse;
        height: 0.9cm;
        vertical-align: middle;
    }
    .content-table td {
        width: 30%;
        padding: 0px 30px;
        height: 0.9cm;
        vertical-align: middle;
        border:1px solid black;
        border-collapse: collapse;
    }
    .span-text-color{
        height: 0.9cm;
        display: flex;
        align-items: center;
    }
    .span-text-color-right{
        background-color: rgba(0,0,0,0.08);
    }
    .span-text{
        height: 0.9cm;
        display: flex;
        align-items: center;
    }
    .text-right {
        text-align: right;
    }
 
    .text-center {
        text-align: center;
    }
 
    .val {
        white-space: nowrap;
    }
 
    .val-ltr {
        direction: ltr;
        text-align: left;
        unicode-bidi: embed;
    }
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
        padding-top: 5.5cm;
        width: 210mm;
        min-height: 135mm;
        height:auto;
        margin: 0 !important;  
        padding-left: 1.5cm !important;
        padding-right: 1cm !important;
        box-sizing: border-box;
        overflow: hidden;
    }
    }
    </style>
</head>
 
<body>
    @php
    /* تاریخ cell = date only (d/M/Y). وقت cell = time only (g:i:s A). */
    $raw = trim((string) ($data['currentDateTime'] ?? ''));
    $dateOnly = '';
    $timeOnly = '';
    if ($raw !== '' && strtoupper($raw) !== 'N/A') {
    try {
    $dt = \Carbon\Carbon::parse($raw);
    $dateOnly = $dt->format('d/M/Y');
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
                    <td class="label text-center">سیریل نمبر</td>
                    <td class="val text-left">{{ $data['serialNumber'] }}</td>
                    <td class="label text-center">آرڈر نمبر</td>
                    <td class="val text-left">{{ $data['lastPartyBills'] }}</td>
                    <td class="label text-center">تاریخ</td>
                    <td class="val val-ltr">{{ $dateOnly }}</td>
                    <td class="label text-center">وقت</td>
                    <td class="val val-ltr">{{ $timeOnly }}</td>
                </tr>
                <tr>
                    <td class="label text-center">ریٹ فی تولہ</td>
                    <td class="val text-left">{{ $data['tollaRate'] }}</td>
                    <td class="label text-center">ریٹ فی گرام</td>
                    <td class="val text-left">{{ $data['gramRate'] }}</td>
                    <td class="label text-center">ویسٹ فیس دس گرام</td>
                    <td class="val text-left">{{ $data['wasteRate'] }}</td>
                    <td class="label text-center">مزدوری فی گرام</td>
                    <td class="val text-left">0</td>
                </tr>
                <tr>
                    <td class="label text-center">نام و ایڈریس</td>
                    <td colspan="3" class="val text-left">{{ $data['partyName'] }}</td>
                    <td class="label text-center">پارٹی نمبر</td>
                    <td class="val text-left">{{ $data['party_id'] }}</td>
                    <td class="label text-center">کیش کوڈ</td>
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
                                <span class="span-text-color">وزن کاسٹنگ</span>
                                <span class="span-text">{{ $data['weightCastig'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span class="span-text-color">سابقا خالص</span>
                                <span class="val-ltr span-text">{{ $data['advance'] }}</span>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-row">
                                <span class="span-text-color">واپسی کاسٹنگ</span>
                                <span class="span-text">{{ $data['wapsiGold'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span class="span-text-color">کل خالص</span>
                                <span class="val-ltr span-text">{{ $data['totalKhalis'] }}</span>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-row">
                                <span class="span-text-color">نیٹ وزن</span>
                                <span class="span-text">{{ $data['netWeight'] }}</span>
                            </div>
                        </td>
                        <!-- <td>
                            <div class="flex-row">
                                <span class="span-text-color">خالص مزدوری</span>
                                <span class="span-text">{{ $data['mazdoorie'] }}</span>
                            </div>
                        </td> -->


                        <td>
                            <div class="flex-row">
                                <span class="span-text-color">خالص مزدوری</span>
                                <span class="span-text">{{ $data['mazdoorie'] }}</span>
                            </div>
                        </td>

                        
                        <td>
                            <div class="flex-row">
                                <span class="span-text-color">مزدوری</span>
                                <span class="span-text">{{ $data['mazdoorie'] }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-row">
                                <span class="span-text-color">ویسٹ</span>
                                <span class="span-text">{{ $data['wasteCasted'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span class="span-text-color">کل خالص</span>
                                <span class="val-ltr span-text">{{ $data['totalKhalis'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span>سابقا مزدوری</span>
                                <span>{{ $data['remainingMazdoori'] }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-row">
                                <span class="span-text-color">کل وزن</span>
                                <span class="span-text">{{ $data['totalWeight'] }}</span>
                            </div>
                        </td>
 
                        <td>
                            <div class="flex-row">
                                <span class="span-text-color">وصول خالص</span>
                                <span class="span-text">{{ $data['GoldRecieved'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span class="span-text-color">کل مزدوری</span>
                                <span class="span-text">{{ $data['totalMazdoori'] }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-row">
                                <span class="span-text-color">میل نکلا</span>
                                <span class="span-text">{{ $data['totalWeightCasted'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-row">
                                <span class="span-text-color span-text-color-right">بقایا خالص</span>
                                <span class="val-ltr span-text">{{ $data['RemainingGold'] }}</span>
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
                                <span class="span-text-color">خالص</span>
                                <span class="span-text">{{ $data['khalis'] }}</span>
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