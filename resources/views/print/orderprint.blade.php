<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Table</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="">

    <div class="mt-26 px-24">
        <table class="w-full border border-black text-xs table-fixed">
            <tbody>

                <!-- Row 1 -->
                <tr class="w-full border-b border-black">
                    <td class="w-1/8 p-2 font-bold text-right whitespace-nowrap">سیریل نمبر</td>
                    <td class="w-1/8 p-2 text-left whitespace-nowrap">{{$data['serialNumber']}}</td>
                    <td class="w-1/8 p-2 font-bold text-right whitespace-nowrap">آرڈر نمبر</td>
                    <td class="w-1/8 p-2 text-left whitespace-nowrap">{{$data['lastPartyBills']}}</td>
                    <td class="w-1/8 p-2 font-bold text-right whitespace-nowrap">تاریخ</td>
                    @php
                        // Split date and time
                        $parts = explode(' ', $data['currentDateTime']);  
                        $date = $parts[0] ?? ''; // 07/May/2025
                        // Handle time - could be in format "14:30:45" (24-hour) or "11:17:08 PM" (12-hour)
                        if (isset($parts[1])) {
                            $time = $parts[1];
                            // If there's a third part (AM/PM), add it
                            if (isset($parts[2])) {
                                $time .= ' ' . $parts[2];
                            }
                        } else {
                            $time = '';
                        }
                    @endphp
                    <td class="w-1/8 p-2 text-left whitespace-nowrap">{{$date}}</td>
                    <td class="w-1/8 p-2 font-bold text-right">وقت</td>
                    <td class="w-1/8 p-2 text-left whitespace-nowrap" dir="ltr">{{$time}}</td>
                </tr>

                <!-- Row 2 -->
                <tr class="w-full border-b border-black">
                    <td class="w-1/8 p-2 font-bold text-right whitespace-nowrap">ریٹ فی تولہ</td>
                    <td class="w-1/8 p-2 text-left whitespace-nowrap">{{$data['tollaRate']}}</td>
                    <td class="w-1/8 p-2 font-bold text-right whitespace-nowrap">ریٹ فی گرام</td>
                    <td class="w-1/8 p-2 text-left whitespace-nowrap">{{$data['gramRate']}}</td>
                    <td class="w-1/8 p-2 font-bold text-right whitespace-nowrap">ویسٹ فیس دس گرام</td>
                    <td class="w-1/8 p-2 text-left whitespace-nowrap">{{$data['wasteDiscountRate']}}</td>
                    <td class="w-1/8 p-2 font-bold text-right whitespace-nowrap">مزدوری فی گرام</td>
                    <td class="w-1/8 p-2 text-left whitespace-nowrap">0</td>
                </tr>

                <!-- Row 3 -->
                <tr class="w-full border-b border-black">
                    <td class="w-1/6 p-2 font-bold text-right">نام و ایڈریس</td>
                    <td colspan="3" class="w-1/6 p-2 text-left whitespace-nowrap">{{$data['partyName']}}</td>
                    <td class="w-1/6 p-2 font-bold text-right">پارٹی نمبر</td>
                    <td class="w-1/6 p-2 text-left whitespace-nowrap">{{$data['party_id']}}</td>
                    <td class="w-1/6 p-2 font-bold text-right">کیش کوڈ</td>
                    <td class="w-1/6 p-2 text-left whitespace-nowrap">
                        ({{ $data['InOutCheck'] == 1 ? 'IN' : 'OUT' }})
                        {{$data['mailCode']}} 
                        <span class="font-bold text-left">رتی</span>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="mt-5 px-26">
        <table class="table-fixed w-full text-sm border border-gray-300">
            <tbody>
                <!-- <tr>
                    <td class="border border-gray-300 w-1/3 p-2"></td>
                    <td class="border border-gray-300 w-1/3 p-2"></td>
                    <td class="border border-gray-300 w-1/3 p-2"></td>
                </tr> -->

                <tr>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>وزن کاسٹنگ</span>
                            <span>{{$data['weightCastig']}}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>سابقا خالص</span>
                            <span dir="ltr">{{$data['advance']}}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 w-1/3 p-2">
                    </td>
                </tr>

                <tr>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>واپسی کاسٹنگ</span>
                            <span>{{$data['wapsiGold']}}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>کل خالص</span>
                            <span dir="ltr">{{$data['totalKhalis']}}</span>
                        </div>
                    </td>

                    <td class="border border-gray-300 w-1/3 p-2">
                    </td>
                </tr>

                <tr>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>نیٹ وزن</span>
                            <span>{{$data['netWeight']}}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>خالص مزدوری</span>
                            <span>{{$data['mazdoorie']}}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>مزدوری</span>
                            <span>{{$data['mazdoorie']}}</span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>ویسٹ</span>
                            <span>{{$data['wasteCasted']}}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>کل خالص</span>
                            <span dir="ltr">{{$data['totalKhalis']}}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>سابقا مزدوری</span>
                            <span>{{$data['remainingMazdoori']}}</span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>کل وزن</span>
                            <span>{{$data['totalWeight']}}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>وصول خالص</span>
                            <span>{{$data['GoldRecieved']}}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>کل مزدوری</span>
                            <span>{{$data['totalMazdoori']}}</span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>میل نکلا</span>
                            <span>{{$data['totalWeightCasted']}}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>بقایا خالص</span>
                            <span dir="ltr">{{$data['RemainingGold']}}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>پَٹھور</span>
                        </div>
                    </td>
                </tr>


                <tr class="border border-gray-300">
                    <td class="border border-gray-300 w-1/3 p-2">
                        <div class="flex justify-between">
                            <span>خالص</span>
                            <span>{{$data['khalis']}}</span>
                        </div>
                    </td>

                    <td class="border border-gray-300 w-1/3 p-2 text-right">
                    </td>
                    <td class="border border-gray-300 w-1/3 p-2">
                    </td>
                </tr>

            </tbody>
        </table>

    </div>

</body>

</html>