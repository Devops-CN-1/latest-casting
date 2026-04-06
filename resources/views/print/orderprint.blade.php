<!DOCTYPE html>
<html lang="ur" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Print</title>
    <style>
        /* Pre-printed slip: 21 cm × 13.5 cm (landscape). Data overlay only — no borders on paper. */
        @page {
            size: 210mm 135mm;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 210mm;
            min-height: 135mm;
            font-family: 'Segoe UI', Tahoma, Arial, sans-serif;
            font-size: 10px;
            line-height: 1.25;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Top 1 cm (header); right 0; left + bottom reserved */
        .print-sheet {
            width: 210mm;
            min-height: 135mm;
            margin: 4cm 1.5cm 0 1.5cm;
            padding-top: 1.8cm;
            padding-right: 0;
            padding-bottom: 1.4cm;
            /* padding-left: 2cm; */
        }

        .overlay-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .overlay-table td {
            padding: 2px 4px;
            vertical-align: middle;
            word-wrap: break-word;
            /* width: 12.5%; */
            height: 0.9cm;
        }

        .label {
            font-weight: 700;
            white-space: nowrap;
        }

        .val {
            white-space: nowrap;
        }

        .val-ltr {
            direction: ltr;
            text-align: left;
            unicode-bidi: embed;
        }

        /* Screen preview: light guides only */
        @media screen {
            body {
                background: #e8e8e8;
            }

            .print-sheet {
                background: #fff;
                margin: 12px auto;
                box-shadow: 0 0 0 1px #ccc;
            }

            .overlay-table td {
                outline: 1px dashed rgba(0, 0, 0, 0.12);
            }
        }

        /* On paper: no lines (form already printed) */
        @media print {
            @page {
            size: 210mm 135mm;
            margin: 0;
        }
        
            html,
            body {
                background: transparent !important;
            }

            .overlay-table,
            .overlay-table td,
            .overlay-table tr {
                border: none !important;
                outline: none !important;
                background: transparent !important;
                box-shadow: none !important;
            }

            .print-sheet {
                margin: 0;
                box-shadow: none;
            }
        }

        .section-gap {
            margin-top: 6px;
        }

        table.grid-3 td {
            width: 30%;
            padding: 3px 25px;
        }

        .text-xs {
            font-size: 10px;
        }

        .text-sm {
            font-size: 11px;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
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
        <table class="overlay-table text-xs">
            <tbody>
                <tr>
                    <td class="label text-right" style="visibility: hidden;">سیریل نمبر</td>
                    <td class="val text-left">{{ $data['serialNumber'] }}</td>
                    <td class="label text-right" style="visibility: hidden;">آرڈر نمبر</td>
                    <td class="val text-left">{{ $data['lastPartyBills'] }}</td>
                    <td class="label text-right" style="visibility: hidden;">تاریخ</td>
                    <td class="val text-left">{{ $dateOnly }}</td>
                    <td class="label text-right" style="visibility: hidden;">وقت</td>
                    <td class="val val-ltr">{{ $timeOnly }}</td>
                </tr>
                <tr>
                    <td class="label text-right" style="visibility: hidden;">ریٹ فی تولہ</td>
                    <td class="val text-left">{{ $data['tollaRate'] }}</td>
                    <td class="label text-right" style="visibility: hidden;">ریٹ فی گرام</td>
                    <td class="val text-left">{{ $data['gramRate'] }}</td>
                    <td class="label text-right" style="visibility: hidden;">ویسٹ فیس دس گرام</td>
                    <td class="val text-left">{{ $data['wasteRate'] }}</td>
                    <td class="label text-right" style="visibility: hidden;">مزدوری فی گرام</td>
                    <td class="val text-left">0</td>
                </tr>
                <tr>
                    <td class="label text-right" style="visibility: hidden;">نام و ایڈریس</td>
                    <td colspan="3" class="val text-left">{{ $data['partyName'] }}</td>
                    <td class="label text-right" style="visibility: hidden;">پارٹی نمبر</td>
                    <td class="val text-left">{{ $data['party_id'] }}</td>
                    <td class="label text-right" style="visibility: hidden;">کیش کوڈ</td>
                    <td class="val text-left">
                        ({{ $data['InOutCheck'] == 1 ? 'IN' : 'OUT' }})
                        {{ $data['mailCode'] }}
                        <span class="label">رتی</span>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="section-gap">
            <table class="overlay-table text-sm grid-3">
                <tbody>
                    <tr>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>وزن کاسٹنگ</span>
                                <span>{{ $data['weightCastig'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>سابقا خالص</span>
                                <span class="val-ltr">{{ $data['advance'] }}</span>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>واپسی کاسٹنگ</span>
                                <span>{{ $data['wapsiGold'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>کل خالص</span>
                                <span class="val-ltr">{{ $data['totalKhalis'] }}</span>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>نیٹ وزن</span>
                                <span>{{ $data['netWeight'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>خالص مزدوری</span>
                                <span>{{ $data['mazdoorie'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>مزدوری</span>
                                <span>{{ $data['mazdoorie'] }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>ویسٹ</span>
                                <span>{{ $data['wasteCasted'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>کل خالص</span>
                                <span class="val-ltr">{{ $data['totalKhalis'] }}</span>
                            </div>
                        </td>
                        <!-- <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>سابقا مزدوری</span>
                                <span>{{ $data['remainingMazdoori'] }}</span>
                            </div>
                        </td> -->
                    </tr>
                    <tr>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>کل وزن</span>
                                <span>{{ $data['totalWeight'] }}</span>
                            </div>
                        </td>
                        
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>وصول خالص</span>
                                <span>{{ $data['GoldRecieved'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>کل مزدوری</span>
                                <span>{{ $data['totalMazdoori'] }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>میل نکلا</span>
                                <span>{{ $data['totalWeightCasted'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>بقایا خالص</span>
                                <span class="val-ltr">{{ $data['RemainingGold'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>مزدوری کا سونا</span>
                                <span>{{ $data['mazdooriGold'] }}</span>
                            </div>
                        </td>

                        <!-- <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
                                <span>پَٹھور</span>
                            </div>
                        </td> -->
                    </tr>
                    <tr>
                        <td>
                            <div style="display:flex;justify-content:space-between;gap:6px;">
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
