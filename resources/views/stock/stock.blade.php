@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="w-full p-2 bg-[#ece9d8] h-screen">
            <!-- table container  -->
            <div
                class="h-60 overflow-y-auto border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#808080]">
                <div id="stockTable">
                    
                </div>
            </div>
            <!-- form container  -->
            <div class="mt-2">
                <div class="w-full flex gap-3">
                    <div class="w-4/6 xl:w-3/4">
                        <div class="w-full flex">
                            <div class="w-1/5">
                                <label class="block text-center font-semibold bg-[#ffffc0]">Total_Weight</label>
                                <input type="number" readonly
                                    class="min-w-0 w-full p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#c0c0ff]" />
                            </div>
                            <div class="w-1/5">
                                <label class="block text-center font-semibold bg-[#ffffc0]">Total_Waste</label>
                                <input type="number" readonly
                                    class="min-w-0 w-full p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#c0c0ff]" />
                            </div>
                            <div class="w-1/5">
                                <label class="block text-center font-semibold bg-[#ffffc0]">Total_Mazdori</label>
                                <input type="number" readonly
                                    class="min-w-0 w-full p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#c0c0ff]" />
                            </div>
                            <div class="w-1/5">
                                <label class="block text-center font-semibold bg-[#ffffc0]">Khalis</label>
                                <input type="number" readonly
                                    class="min-w-0 w-full p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#c0c0ff]" />
                            </div>
                            <div class="w-1/5">
                                <label class="block text-center font-semibold bg-[#ffffc0]">Khalis_Mazdori</label>
                                <input type="number" readonly
                                    class="min-w-0 w-full p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#c0c0ff]" />
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-3/5 mt-2 flex gap-x-3">
                                <div class="w-1/2 xl:w-3/5 space-y-1">
                                    <div class="flex gap-3 items-center">
                                        <label class="shrink-0 w-12 px-1 font-semibold bg-[#ffc0ff]">From</label>
                                        <input type="date" id="dateFrom"
                                            class="w-full text-sm px-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white placeholder-transparent [&::-webkit-calendar-picker-indicator]:hidden" />
                                        <button class="bg-[#ff8080] px-1" onclick="openCalendar('dateFrom')">C</button>
                                    </div>
                                    <div class="flex gap-3 items-center">
                                        <label class="shrink-0 w-12 px-1 font-semibold bg-[#ffc0ff]">To</label>
                                        <input type="date" id="dateTo"
                                            class="w-full text-sm px-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white placeholder-transparent [&::-webkit-calendar-picker-indicator]:hidden" />
                                        <button class="bg-[#ff8080] px-1" onclick="openCalendar('dateTo')">C</button>
                                    </div>
                                    <div class="flex gap-3 items-center">
                                        <label class="shrink-0 w-12 px-1 font-semibold bg-[#ffc0ff]">Party</label>
                                        <input type="number" id="partyId" 
                                            class="w-full text-sm px-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                                    </div>
                                    <div class="flex gap-3 items-center">
                                        <label class="shrink-0 w-12 px-1 font-semibold bg-[#ffe0c0]">Gold</label>
                                        <input type="number" id="goldStockEnter" 
                                            class="w-full text-sm px-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                                        <input type="checkbox">
                                    </div>
                                    <div class="flex gap-3 items-center">
                                        <label class="shrink-0 w-12 px-1 font-semibold bg-[#ffe0c0]">Cash</label>
                                        <input type="number" id="cashStockEnter" 
                                            class="w-full text-sm px-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                                        <div>
                                            <button class="px-2 text-sm bg-[#008000]" id="enterStock">Enter Stock</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-1/2 xl:w-2/5">
                                    <div class="flex gap-2">


                                        <button
                                            class="min-w-20 w-full py-1 font-semibold border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] bg-[#8080ff]" id="parchi" >Parchi</button>
                                        </button>


                                        <button id="oldRecord" onclick="oldRecord()" 
                                            class="min-w-20 w-full py-1 font-semibold border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] bg-[#ffc080]">Old</button>
                                        </button>

                                    </div>
                                    <div class="flex">

                                        <!-- <button
                                            class="min-w-24 w-full text-xs py-1 font-semibold bg-[#ffe0c0] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Delete
                                            Party</button>
                                        </button>

                                        <button
                                            class="min-w-24 w-full text-xs py-1 font-semibold bg-[#ffe0c0] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Refresh
                                            Record</button>
                                        </button> -->

                                    </div>
                                    <div>
                                        <button id="showAllRecords" 
                                            class="py-1 w-full font-semibold bg-[#008000] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Show
                                            All Records</button>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="w-2/5 mt-2">
                                <div class="flex items-center bg-[#c0c0ff]">
                                    <a class="w-1/5 block" onclick="stockTotal()">
                                        Stock
                                    </a>
                                    <span class="w-2/5 block">
                                        Gold
                                    </span>
                                    <span class="w-2/5 block">
                                        Cash
                                    </span>
                                </div>
                                <div class="flex items-center  bg-[#ffc080]">
                                    <label class="block w-1/5 font-semibold">Instock</label>
                                    <input type="number" readonly id="goldStock" 
                                        class="w-2/5 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#ffc080]" />
                                    <input type="number" readonly id="cashStock" 
                                        class="w-2/5 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#ffc080]" />
                                </div>
                                <div class="flex items-center bg-[#c0c0ff]">
                                    <label class="block w-1/5 font-semibold">Laina +</label>
                                    <input type="number" readonly id="goldLaina" 
                                        class="w-2/5 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#c0c0ff]" />
                                    <input type="number" readonly id="cashLaina" 
                                        class="w-2/5 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#c0c0ff]" />
                                </div>
                                <div class="flex items-center bg-[#ffc0ff]">
                                    <label class="block w-1/5 font-semibold">Daina -</label>
                                    <input type="number" readonly id="goldDaina" 
                                        class="w-2/5 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#ffc0ff]" />
                                    <input type="number" readonly id="cashDaina" 
                                        class="w-2/5 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#ffc0ff]" />
                                </div>
                                <div class="flex items-center bg-[#ffffc0]">
                                    <label class="block w-1/5 font-semibold">Total Earn</label>
                                    <input type="number" readonly id="totalEarnGold" 
                                        class="w-2/5 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#ffffe1]" />
                                    <input type="number" readonly id="totalEarnCash" 
                                        class="w-2/5 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#ffffe1]" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-4/12 xl:w-1/4 space-y-2">
                        <div class="flex justify-between">
                            <button id="leenaCashGold" 
                                class="w-24 text-center py-1 font-semibold border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] bg-[#ff0000]">Leena</button>
                            <button id="deenaCashGold"
                                class="w-24 text-center py-1 font-semibold border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] bg-[#c000c0]">Deena</button>
                            <button id="printTableBtn"
                                class="w-24 text-center py-1 font-semibold border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] bg-[#1c8684]">Print</button>

                        </div>
                        <div class="flex justify-between">
                            <button id="stockGoldList" 
                                class="w-24 text-center py-1 font-semibold bg-[#ffff80] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Gold
                                List</button>
                            <button id="stockCashList" 
                                class="w-24 text-center py-1 font-semibold bg-[#ff8080] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Cash
                                List</button>
                            <button
                                class="w-24 text-center py-1 font-semibold bg-[#804040] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]"
                                style="visibility: hidden; pointer-events: none;">FreeStock</button>

                        </div>
                        <div class="flex justify-between">
                            <button id="expenseGoldList" 
                                class="w-24 text-center py-1 font-semibold bg-[#ffffc0] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Expense
                                Gold List</button>
                            <button id="expenseCashList" 
                                class="w-24 text-center py-1 font-semibold bg-[#ffc0c0] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Expense
                                Cash List</button>
                            <button
                                class="w-24 text-center py-1 font-semibold bg-[#804000] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]"
                                style="visibility: hidden; pointer-events: none;">TotalClean</button>

                        </div>
                        <div>
                            <a href="{{url('/')}}" 
                                class="w-full text-center py-1 font-semibold bg-[#808000] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex gap-2 mt-2">
                <div class="w-28 space-y-2">
                    <button onclick="maxOrder()"
                        class="w-full text-center py-1.5 font-semibold bg-[#c0c0ff] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Max
                        Order</button>
                    </button>
                    <button onclick="maxWaste()"
                        class="w-full text-center py-1.5 font-semibold bg-[#ffc0ff] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Max
                        Waste</button>
                    </button>
                </div>
                <div class="w-1/6 space-y-2">

                    <label class="block text-center font-semibold bg-[#008080]">Exp Sona</label>
                    <input type="number" id="expSona"  placeholder="Gold" 
                        class="px-1 w-full text-sm outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                    <input type="text" id="expSonaRemarks"  placeholder="Remarks" 
                        class="px-1 w-full text-sm outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />

                </div>
                <div class="w-1/6 space-y-2">

                    <label class="block text-center font-semibold bg-[#008080]">Exp Cash</label>
                    <input type="number" id="expCash" placeholder="Cash"  
                        class="px-1 w-full text-sm outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                    <input type="text" id="expCashRemarks" placeholder="Remarks" 
                        class="px-1 w-full text-sm outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />

                </div>
                <div class="w-1/6 space-y-2">
                    <label class="block text-center font-semibold bg-[#00c000]">Sell Sona</label>
                    <input type="number"placeholder="Gold"  id="sellSona" 
                        class="px-1 w-full text-sm outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                    <input type="number" placeholder="Rupees"  id="sellSonaInRupees" 
                        class="px-1 w-full text-sm outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />

                </div>
                <div class="w-1/6 space-y-2">
                    <label class="block text-center font-semibold bg-[#ff0000]">Buy Sona</label>
                    <input type="number" id="cashForBuyGold"  placeholder="cash" 
                        class="px-1 w-full text-sm outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#d4f8cf]" />
                    <input type="number" id="rateToBuyGold"  placeholder="Tola rate" 
                        class="px-1 w-full text-sm outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#00c000]" />
                </div>
                <div class="w-1/6">

                    <label class="block text-center font-semibold bg-[#ff0000]">Delete Cash Party History</label>
                    <label
                        class="block text-center text-xs leading-none xl:leading-9 font-semibold bg-[#ffffc0]">Mazdori
                        In Gold</label>
                    <input type="number"
                        class="px-1 w-full text-sm outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#c0c0ff]" />

                </div>
                <div class="w-1/6 space-y-2">
                    <input type="text" id="dateField"
                        class="p-1 font-semibold w-full text-sm text-center outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#ffc080]"
                         />
                    <button
                        class="w-full text-center py-2 font-semibold bg-[#808000] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Clear
                        Date</button>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Loader Overlay -->
    <div id="tableLoader" class="fixed inset-0 bg-transparent z-50 hidden flex items-center justify-center">
        <div class="flex flex-col items-center">
            <div class="loader-spinner mb-4"></div>
            <p class="text-gray-800 font-semibold text-lg drop-shadow-lg">Loading data...</p>
        </div>
    </div>

    <style>
        .loader-spinner {
            width: 60px;
            height: 60px;
            position: relative;
        }

        .loader-spinner::before,
        .loader-spinner::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            border: 4px solid transparent;
        }

        .loader-spinner::before {
            width: 60px;
            height: 60px;
            border-top: 4px solid #3498db;
            border-right: 4px solid #3498db;
            animation: spin 0.8s linear infinite;
        }

        .loader-spinner::after {
            width: 40px;
            height: 40px;
            top: 10px;
            left: 10px;
            border-bottom: 4px solid #e74c3c;
            border-left: 4px solid #e74c3c;
            animation: spinReverse 0.6s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes spinReverse {
            0% { transform: rotate(360deg); }
            100% { transform: rotate(0deg); }
        }

        /* DataTables Search Input Styling */
        .dataTables_wrapper .dataTables_filter input {
            background-color: white !important;
            border: 2px solid #d1d5db !important;
            border-radius: 4px !important;
            padding: 8px 12px !important;
            margin-left: 10px !important;
            font-size: 14px !important;
            color: #1f2937 !important;
            outline: none !important;
            transition: border-color 0.2s !important;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        }

        .dataTables_wrapper .dataTables_filter label {
            color: #374151 !important;
            font-weight: 500 !important;
        }

        /* Apply color changes only in dark mode */
        @media (prefers-color-scheme: dark) {
            /* Force input text color to black in dark mode */
            input[type="text"],
            input[type="number"],
            input[type="email"],
            input[type="password"],
            input[type="date"],
            textarea,
            select {
                color: #000000 !important;
            }

            /* Ensure input placeholder text is visible in dark mode */
            input[type="text"]::placeholder,
            input[type="number"]::placeholder,
            input[type="email"]::placeholder,
            input[type="password"]::placeholder,
            input[type="date"]::placeholder,
            textarea::placeholder {
                color: #666666 !important;
            }

            /* Force table text color to black in dark mode */
            table,
            table td,
            table th,
            table tr,
            .dataTables_wrapper table,
            .dataTables_wrapper table td,
            .dataTables_wrapper table th,
            .dataTables_wrapper table tr {
                color: #000000 !important;
            }

            /* Force button and label text to black in dark mode */
            /* This ensures white/cream text becomes black in dark mode */
            button:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            label:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]) {
                color: #000000 !important;
            }

            /* Override white and cream colors in dark mode */
            button[class*="text-white"],
            label[class*="text-white"],
            button[class*="text-cream"],
            label[class*="text-cream"],
            button[style*="color: white"],
            button[style*="color: #fff"],
            button[style*="color: #ffffff"],
            button[style*="color: #fefefe"],
            button[style*="color: #f5f5f5"],
            label[style*="color: white"],
            label[style*="color: #fff"],
            label[style*="color: #ffffff"],
            label[style*="color: #fefefe"],
            label[style*="color: #f5f5f5"] {
                color: #000000 !important;
            }

            /* Force p, a, and span tag text to black in dark mode */
            p:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            a:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            span:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]) {
                color: #000000 !important;
            }

            /* Override white and cream colors for p, a, and span tags in dark mode */
            p[class*="text-white"],
            a[class*="text-white"],
            span[class*="text-white"],
            p[class*="text-cream"],
            a[class*="text-cream"],
            span[class*="text-cream"],
            p[style*="color: white"],
            p[style*="color: #fff"],
            p[style*="color: #ffffff"],
            p[style*="color: #fefefe"],
            p[style*="color: #f5f5f5"],
            a[style*="color: white"],
            a[style*="color: #fff"],
            a[style*="color: #ffffff"],
            a[style*="color: #fefefe"],
            a[style*="color: #f5f5f5"],
            span[style*="color: white"],
            span[style*="color: #fff"],
            span[style*="color: #ffffff"],
            span[style*="color: #fefefe"],
            span[style*="color: #f5f5f5"] {
                color: #000000 !important;
            }
        }
    </style>

    <!-- DataTables CSS (local for offline) -->
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <!-- DataTables JS (local for offline) -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

    <script>

        // Loader functions
        function showLoader() {
            $('#tableLoader').removeClass('hidden');
        }

        function hideLoader() {
            $('#tableLoader').addClass('hidden');
        }

        // DataTables initialization helper function
        function initDataTable(tableId, hasData) {
            // If no data, don't initialize DataTables
            if (hasData === false) {
                return;
            }
            // Guard: DataTables may not be loaded (e.g. script failed or wrong order)
            if (!$.fn.DataTable || !$.fn.DataTable.isDataTable) {
                return;
            }
            // Destroy existing DataTable if it exists
            if ($.fn.DataTable.isDataTable('#' + tableId)) {
                try {
                    $('#' + tableId).DataTable().destroy();
                } catch(e) {
                    // Ignore errors if table doesn't exist
                }
            }
            
            // Wait for DOM to be ready and table to be fully rendered
            setTimeout(function() {
                var $table = $('#' + tableId);
                
                // Check if table exists and has proper structure
                if ($table.length > 0 && $table.find('thead').length > 0 && $table.find('tbody').length > 0) {
                    var $thead = $table.find('thead tr');
                    var $tbody = $table.find('tbody tr');
                    
                    // Count columns in header
                    var headerCols = $thead.find('th').length;
                    
                    // Check if there are actual data rows (not just empty state)
                    var hasDataRows = $tbody.length > 0 && !$tbody.first().find('td[colspan]').length;
                    
                    // If no data rows, don't initialize DataTables
                    if (!hasDataRows) {
                        return;
                    }
                    
                    // Count columns in first data row
                    var firstRow = $tbody.first();
                    var dataCols = firstRow.find('td').length;
                    var allRowsValid = true;
                    
                    // Verify all rows have the same column count
                    $tbody.find('tr').each(function() {
                        var rowCols = $(this).find('td').length;
                        if (rowCols !== dataCols && !$(this).find('td[colspan]').length) {
                            allRowsValid = false;
                        }
                    });
                    
                    // Only initialize if column counts match and all rows are valid
                    if (headerCols === dataCols && headerCols > 0 && allRowsValid) {
                        try {
                            // Initialize DataTable with search and filtering
                            $table.DataTable({
                                "pageLength": 10,
                                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                                "order": [[0, "asc"]],
                                "searching": true,
                                "paging": true,
                                "info": true,
                                "ordering": true,
                                "autoWidth": false,
                                "language": {
                                    "search": "Search:",
                                    "lengthMenu": "Show _MENU_ entries",
                                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                                    "infoFiltered": "(filtered from _MAX_ total entries)",
                                    "zeroRecords": "No matching records found"
                                }
                            });
                        } catch(e) {
                            console.error('Error initializing DataTable for ' + tableId + ':', e);
                        }
                    } else {
                        console.warn('Column count mismatch for ' + tableId + ': Header=' + headerCols + ', Data=' + dataCols);
                    }
                }
            }, 200);
        }

        function stockTotal(){

            $.ajax({
                    url: '/api/stock-total',
                    type: 'get',
                    headers: {
                        'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                        'Accept': 'application/json'
                    },
                success: function(response) {

                    // ✅ Set stock values with rounding
                $('#goldStock').val(
                    (Math.ceil(response.data[0].stockGoldBalance * 1000) / 1000).toFixed(3)
                );
                $('#cashStock').val(
                    (Math.ceil(response.data[0].stockCashBalance * 100) / 100).toFixed(2)
                );

                // ✅ Get values as numbers
                var goldStock  = parseFloat($('#goldStock').val())  || 0;
                var cashStock  = parseFloat($('#cashStock').val())  || 0;

                var goldLaina  = parseFloat($('#goldLaina').val())  || 0;
                var goldDaina  = parseFloat($('#goldDaina').val())  || 0;
                var cashLaina  = parseFloat($('#cashLaina').val())  || 0;
                var cashDaina  = parseFloat($('#cashDaina').val())  || 0;

                // ✅ Calculate totals
                var totalEarnGold = (goldStock + goldLaina) - goldDaina;
                var totalEarnCash = (cashStock + cashLaina) - cashDaina;

                // ✅ Show results with formatting
                $('#totalEarnGold').val((Math.ceil(totalEarnGold * 1000) / 1000).toFixed(3));
                $('#totalEarnCash').val((Math.ceil(totalEarnCash * 100) / 100).toFixed(2));

                },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON, 'Error');
                    }
                });
        }

        const today = new Date();
        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const day = today.getDate();
        const month = months[today.getMonth()];
        const year = today.getFullYear();

        const formattedDate = `${day} ${month} ${year}`;
        document.getElementById('dateField').value = formattedDate;


        function openCalendar(id) {
            const input = document.getElementById(id);
            if (input && typeof input.showPicker === 'function') {
                input.showPicker(); // Modern browsers
            } else {
                input.focus();      // Fallback
                input.click();      // Sometimes works
            }
        }


        $('#parchi').click(function () {
            var dateFrom = $('#dateFrom').val();
            var dateTo = $('#dateTo').val();
            var partyId = $('#partyId').val();

            // ✅ Validate inputs
            if (dateFrom === '' && dateTo === '' && partyId === '') {
                toastr.error('Please select From Date, To Date or Party ID', 'Error');
                return false;
            }

            showLoader();
            $.ajax({
                url: '/api/get-stock-data',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                    'Accept': 'application/json'
                },
                data: {
                    from_date: dateFrom,
                    to_date: dateTo,
                    party_id: partyId
                },
                success: function(response) {
                    
                    // If you want pretty dates:
                  const fmt = (iso) => new Date(iso).toLocaleString();
                        if (response.data.length > 0) {
                            let table = `
                                <table id="parchiTable" class="min-w-full border-collapse border border-gray-300">
                                    <thead>
                                        <tr class="bg-gray-200 text-gray-700">
                                            <th class="border border-gray-300 px-4 py-2 text-left">P.ID</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">C.W</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">P.G : Mail</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">W</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">K</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Adv:Maz</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">M.G</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Adv:T.G</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">R.G</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">M.G</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;

                            response.data.forEach(function(item) {
                                table += `
                                    <tr class="hover:bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2">${item.party_id || '--'}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.castingWeight || 0}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.mazdoriRate || 0} : ${item.mailCode || 0}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.wasteCasted || 0}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.khalis || 0}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.remainingMazdoori || 0} : ${item.totalMazdoori || 0}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.totalMazdooriInGold || 0}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.advance || 0} : ${item.totalGold || 0}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.op2RemainingGold || 0}</td>
                                        <td class="border border-gray-300 px-4 py-2">----</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.created_at ? fmt(item.created_at) : ''}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.remarks}</td>
                                    </tr>`;
                            });

                            table += `</tbody></table>`;

                            // Append to container
                            $('#stockTable').html(table);
                            
                            // Initialize DataTable after DOM update
                            setTimeout(function() {
                                initDataTable('parchiTable');
                            }, 50);
                        } else {
                            $('#stockTable').html('<p class="text-red-500">No data found.</p>');
                        }
                        hideLoader();
                    },
                        error: function (xhr) {
                            toastr.error(xhr.responseJSON, 'Error');
                            hideLoader();
                }
            });
        });    

            $('#oldRecord').click(function () {
            var dateFrom = $('#dateFrom').val();
            var dateTo = $('#dateTo').val();
            var partyId = $('#partyId').val();

            // ✅ Validate inputs
            if (dateFrom === '' || dateTo === '' || partyId === '') {
                toastr.error('Please select From Date, To Date and Party ID', 'Error');
                return false;
            }

            showLoader();
            $.ajax({
                url: '/api/old-record',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                    'Accept': 'application/json'
                },
                data: {
                    from_date: dateFrom,
                    to_date: dateTo,
                    party_id: partyId
                },
                success: function(response) {
                  const fmt = (iso) => new Date(iso).toLocaleString();
                        if (response.records.length > 0) {
                            let table = `
                                <table id="oldRecordTable" class="min-w-full border-collapse border border-gray-300">
                                    <thead>
                                        <tr class="bg-gray-200 text-gray-700">
                                            <th class="border border-gray-300 px-4 py-2 text-left">PartyID</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Gold</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Cash</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Remarks</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Date and time</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;

                            response.records.forEach(function(item) {
                                table += `
                                    <tr class="hover:bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2">${item.party_id || '--'}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.gold || 0}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.cash || 0}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.status || 0}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.remarks || 0}</td>
                                        <td class="border border-gray-300 px-4 py-2">${item.created_at ? fmt(item.created_at) : ''}</td>
                                    </tr>`;
                            });

                            table += `</tbody></table>`;

                            // Append to container
                            $('#stockTable').html(table);
                            
                            // Initialize DataTable after DOM update (only if data exists)
                            setTimeout(function() {
                                initDataTable('oldRecordTable', true);
                            }, 50);
                        } else {
                            $('#stockTable').html('<p class="text-red-500">No data found.</p>');
                        }

                        let totals = response.totals;
                        if (totals.cash_balance < 0) {
                            $('#cashDaina').val(Math.abs(totals.cash_balance).toFixed(2));
                            $('#cashLaina').val(0);
            
                        } else {
                            $('#cashLaina').val(totals.cash_balance);
                            $('#cashDaina').val(0);
                           
                        }

                        // --- Check Gold Balance ---
                        if (totals.gold_balance < 0) {
                            $('#goldDaina').val(Math.abs(totals.gold_balance).toFixed(2));
                            $('#goldLaina').val(0);
                            
                        } else {
                            $('#goldLaina').val(Math.abs(totals.gold_balance).toFixed(2));
                            $('#goldDaina').val(0);
                            
                        }
                        hideLoader();
                    },
                        error: function (xhr) {
                            toastr.error(xhr.responseJSON, 'Error');
                            hideLoader();
                }
            });
        });

        $('#enterStock').click(function () {
            var goldStockEnter = $('#goldStockEnter').val();
            var cashStockEnter = $('#cashStockEnter').val();
            // ✅ Validate inputs
            if (goldStockEnter === '' && cashStockEnter === '') {
                toastr.error('Please select Gold or Cash', 'Error');
                return false;
            }

            $.ajax({
                url: '/api/Enter-gold-cash-stock',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                    'Accept': 'application/json'
                },
                data: {
                    goldStock_Enter: goldStockEnter,
                    cashStock_Enter: cashStockEnter,
                },
                success: function(response) {

                    toastr.success('Stock Add successfully', 'Success');
                    $('#goldStockEnter').val('');
                    $('#cashStockEnter').val('');
                    stockTotal()
                    
                },
                error: function (xhr) {
                   toastr.error(xhr.responseJSON, 'Error');
                }
            });
        });

        // Enter key: Gold → Cash → Enter Stock button (then submit)
        $('#goldStockEnter').on('keydown', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#cashStockEnter').focus();
            }
        });
        $('#cashStockEnter').on('keydown', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#enterStock').focus();
            }
        });
        $('#enterStock').on('keydown', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $(this).click();
            }
        });

        $('#expSona').on('keydown', function(e) {
            if (e.which === 13 || e.which === 9) {
                $('#expSonaRemarks').focus();
            }
        });

        
        $('#expSonaRemarks').on('keydown', function(e) {
            if (e.which === 13) {

                var expSona = $('#expSona').val();
                var expRemarks = $('#expSonaRemarks').val();
                // ✅ Validate inputs
                if (expSona === '' && expRemarks === '') {
                    toastr.error('Please Add Gold and Remarks', 'Error');
                    return false;
                }

                $.ajax({
                    url: '/api/add-exp-sona',
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                        'Accept': 'application/json'
                    },
                    data: {
                        exp_Sona: expSona,
                        exp_Remarks: expRemarks,
                    },
                    success: function(response) {

                        toastr.success('Expense Gold Add successfully', 'Success');
                        $('#expSona').val('');
                        $('#expSonaRemarks').val('');
                        stockTotal();

                    },
                    error: function (xhr) {

                        toastr.success(xhr.responseJSON, 'Error');

                    }
                });

            }
        });

        $('#cashForBuyGold').on('keydown', function(e) {
            if (e.which === 13 || e.which === 9) {
                $('#rateToBuyGold').focus();
            }
        });

        $('#rateToBuyGold').on('keydown', function(e) {
            if (e.which === 13) {

                var cashForBuyGold = $('#cashForBuyGold').val();
                var rateToBuyGold = $('#rateToBuyGold').val();
                // ✅ Validate inputs
                if (cashForBuyGold === '' && rateToBuyGold === '') {
                    toastr.error('Please Add Cash and Remarks', 'Error');
                    return false;
                }

                $.ajax({
                    url: '/api/buy-sona',
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                        'Accept': 'application/json'
                    },
                    data: {
                        cash_for_buyGold: cashForBuyGold,
                        rate_to_buy_gold: rateToBuyGold,
                    },
                    success: function(response) {
                        toastr.success('Gold Buy successfully', 'Success');
                        $('#cashForBuyGold').val('');
                        $('#rateToBuyGold').val('');
                        stockTotal();
                    },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON, 'Error');
                    }
                });

            }
        });


        $('#expCash').on('keydown', function(e) {
            if (e.which === 13 || e.which === 9) {
                $('#expCashRemarks').focus();
            }
        });

        $('#sellSona').on('keydown', function(e) {
            if (e.which === 13 || e.which === 9) {
                $('#sellSonaInRupees').focus();
            }
        });

        $('#expCashRemarks').on('keydown', function(e) {
            if (e.which === 13) {

                var expCash = $('#expCash').val();
                var expCashRemarks = $('#expCashRemarks').val();
                // ✅ Validate inputs
                if (expCash === '' && expCashRemarks === '') {
                    toastr.error('Please Add Cash and Remarks', 'Error');
                    return false;
                }

                $.ajax({
                    url: '/api/add-exp-cash',
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                        'Accept': 'application/json'
                    },
                    data: {
                        exp_Cash: expCash,
                        exp_Cash_Remarks: expCashRemarks,
                    },
                    success: function(response) {
                        toastr.success('Expense Gold Add successfully', 'Success');
                        $('#expCash').val('');
                        $('#expCashRemarks').val('');
                        stockTotal();
                    },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON, 'Error');
                    }
                });

            }
        });

         $('#sellSona').on('keydown', function(e) {
            if (e.which === 13 || e.which === 9) {
                $('#sellSonaInRupees').focus();
            }
        });

         $('#sellSonaInRupees').on('keydown', function(e) {
            if (e.which === 13) {

                var sellSona = $('#sellSona').val();
                var sellSonaInRupees = $('#sellSonaInRupees').val();
                // ✅ Validate inputs
                if (sellSona === '' && sellSonaInRupees === '') {
                    toastr.error('Please Add Cash and Rupees', 'Error');
                    return false;
                }

                $.ajax({
                    url: '/api/sell-sona',
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                        'Accept': 'application/json'
                    },
                    data: {
                        sell_Sona: sellSona,
                        sell_Sona_In_Rupees: sellSonaInRupees,
                    },
                    success: function(response) {
                       toastr.success('Sell Gold successfully', 'Success');
                        $('#sellSona').val('');
                        $('#sellSonaInRupees').val('');
                        stockTotal();
                    },
                    error: function (xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            toastr.error(xhr.responseJSON.message, 'Error');
                        } else {
                            toastr.error('Something went wrong!', 'Error');
                        }
                    }
                });

            }
        });

        $('#expenseGoldList').on('click', function(e) {
               
                showLoader();
                $.ajax({
                    url: '/api/expense-gold-list',
                    type: 'get',
                    headers: {
                        'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                        'Accept': 'application/json'
                    },
                success: function(response) {
                  const table = $('#stockTable'); // <table id="stockTable"></table>
                  table.empty(); // Clear previous data

                  // If you want pretty dates:
                  const fmt = (iso) => new Date(iso).toLocaleString();

                  // Build full table (thead + tbody) with Tailwind classes
                  let html = `
                    <table id="expenseGoldListTable" class="min-w-full border-collapse border border-gray-300">
                    <thead>
                      <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2 text-left">Serial #</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Gold</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Date Of Expense</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                  `;

                  if (response.data && response.data.length) {
                    $.each(response.data, function(index, item) {
                      html += `
                        <tr class="hover:bg-gray-100">
                          <td class="border border-gray-300 px-4 py-2">${index + 1}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.gold ?? ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.created_at ? fmt(item.created_at) : ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${(item.remarks ?? '').toString()}</td>
                        </tr>
                      `;
                    });
                  } else {
                    html += `
                      <tr>
                        <td colspan="4" class="border border-gray-300 px-4 py-2 text-center">No records found.</td>
                      </tr>
                    `;
                  }

                  html += `</tbody></table>`;

                  table.html(html);
                  
                  // Initialize DataTable after DOM update (only if data exists)
                  var hasData = response.data && response.data.length > 0;
                  setTimeout(function() {
                      initDataTable('expenseGoldListTable', hasData);
                      hideLoader();
                  }, 50);
                },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON, 'Error');
                        hideLoader();
                    }
                });
        });

        $('#expenseCashList').on('click', function(e) {
               
                showLoader();
                $.ajax({
                    url: '/api/expense-cash-list',
                    type: 'get',
                    headers: {
                        'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                        'Accept': 'application/json'
                    },
                success: function(response) {
                  const table = $('#stockTable'); // <table id="stockTable"></table>
                  table.empty(); // Clear previous data

                  // If you want pretty dates:
                  const fmt = (iso) => new Date(iso).toLocaleString();

                  // Build full table (thead + tbody) with Tailwind classes
                  let html = `
                    <table id="expenseCashListTable" class="min-w-full border-collapse border border-gray-300">
                    <thead>
                      <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2 text-left">Serial #</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Cash</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Date Of Expense</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                  `;

                  if (response.data && response.data.length) {
                    $.each(response.data, function(index, item) {
                      html += `
                        <tr class="hover:bg-gray-100">
                          <td class="border border-gray-300 px-4 py-2">${index + 1}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.cash ?? ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.created_at ? fmt(item.created_at) : ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${(item.remarks ?? '').toString()}</td>
                        </tr>
                      `;
                    });
                  } else {
                    html += `
                      <tr>
                        <td colspan="4" class="border border-gray-300 px-4 py-2 text-center">No records found.</td>
                      </tr>
                    `;
                  }

                  html += `</tbody></table>`;

                  table.html(html);
                  
                  // Initialize DataTable after DOM update (only if data exists)
                  var hasData = response.data && response.data.length > 0;
                  setTimeout(function() {
                      initDataTable('expenseCashListTable', hasData);
                      hideLoader();
                  }, 50);
                },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON, 'Error');
                        hideLoader();
                    }
                });
        });

        $('#stockGoldList').on('click', function(e) {
               
                showLoader();
                $.ajax({
                    url: '/api/stock-gold-list',
                    type: 'get',
                    headers: {
                        'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                        'Accept': 'application/json'
                    },
                success: function(response) {
                  const table = $('#stockTable'); // <table id="stockTable"></table>
                  table.empty(); // Clear previous data

                  // If you want pretty dates:
                  const fmt = (iso) => new Date(iso).toLocaleString();

                  // Build full table (thead + tbody) with Tailwind classes
                  let html = `
                    <table id="stockGoldListTable" class="min-w-full border-collapse border border-gray-300">
                    <thead>
                      <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2 text-left">Serial #</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Gold</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                  `;

                  if (response.data && response.data.length) {
                    $.each(response.data, function(index, item) {
                      html += `
                        <tr class="hover:bg-gray-100">
                          <td class="border border-gray-300 px-4 py-2">${index + 1}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.gold ?? ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.status ?? ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.created_at ? fmt(item.created_at) : ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${(item.remarks ?? '').toString()}</td>
                        </tr>
                      `;
                    });
                  } else {
                    html += `
                      <tr>
                        <td colspan="5" class="border border-gray-300 px-4 py-2 text-center">No records found.</td>
                      </tr>
                    `;
                  }

                  html += `</tbody></table>`;

                  table.html(html);
                  
                  // Initialize DataTable after DOM update (only if data exists)
                  var hasData = response.data && response.data.length > 0;
                  setTimeout(function() {
                      initDataTable('stockGoldListTable', hasData);
                      hideLoader();
                  }, 50);
                },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON, 'Error');
                        hideLoader();
                    }
                });
        });

        $('#stockCashList').on('click', function(e) {
               
                showLoader();
                $.ajax({
                    url: '/api/stock-cash-list',
                    type: 'get',
                    headers: {
                        'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                        'Accept': 'application/json'
                    },
                success: function(response) {
                  const table = $('#stockTable'); // <table id="stockTable"></table>
                  table.empty(); // Clear previous data

                  // If you want pretty dates:
                  const fmt = (iso) => new Date(iso).toLocaleString();

                  // Build full table (thead + tbody) with Tailwind classes
                  let html = `
                    <table id="stockCashListTable" class="min-w-full border-collapse border border-gray-300">
                    <thead>
                      <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2 text-left">Serial #</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Cash</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                  `;

                  if (response.data && response.data.length) {
                    $.each(response.data, function(index, item) {
                      html += `
                        <tr class="hover:bg-gray-100">
                          <td class="border border-gray-300 px-4 py-2">${index + 1}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.cash ?? ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.status ?? ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.created_at ? fmt(item.created_at) : ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${(item.remarks ?? '').toString()}</td>
                        </tr>
                      `;
                    });
                  } else {
                    html += `
                      <tr>
                        <td colspan="5" class="border border-gray-300 px-4 py-2 text-center">No records found.</td>
                      </tr>
                    `;
                  }

                  html += `</tbody></table>`;

                  table.html(html);
                  
                  // Initialize DataTable after DOM update (only if data exists)
                  var hasData = response.data && response.data.length > 0;
                  setTimeout(function() {
                      initDataTable('stockCashListTable', hasData);
                      hideLoader();
                  }, 50);
                },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON, 'Error');
                        hideLoader();
                    }
                });
        });


        $('#leenaCashGold').on('click', function(e) {
               
                showLoader();
                $.ajax({
                    url: '/api/leena-Cash-Gold',
                    type: 'get',
                    headers: {
                        'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                        'Accept': 'application/json'
                    },
                success: function(response) {
                  const table = $('#stockTable'); // <table id="stockTable"></table>
                  table.empty(); // Clear previous data

                  // If you want pretty dates:
                  const fmt = (iso) => new Date(iso).toLocaleString();

                  // Build full table (thead + tbody) with Tailwind classes
                  let html = `
                    <table id="leenaCashGoldTable" class="min-w-full border-collapse border border-gray-300">
                    <thead>
                      <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2 text-left">Serial #</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Party</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">PartyName</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">GoldStatus</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">CashStatus</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">PhoneNo</th>
                      </tr>
                    </thead>
                    <tbody>
                  `;

                  if (response.data && response.data.length) {
                    $.each(response.data, function(index, item) {
                      html += `
                        <tr class="hover:bg-gray-100">
                          <td class="border border-gray-300 px-4 py-2">${index + 1}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.party_id ?? ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.party_name ?? ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.gold_balance ?? ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${(item.cash_balance ?? '')}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.phone_number ?? ''}</td>
                        </tr>
                      `;
                    });
                  } else {
                    html += `
                      <tr>
                        <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">No records found.</td>
                      </tr>
                    `;
                  }

                  html += `</tbody></table>`;

                  table.html(html);
                  
                  // Initialize DataTable after DOM update (only if data exists)
                  var hasData = response.data && response.data.length > 0;
                  setTimeout(function() {
                      initDataTable('leenaCashGoldTable', hasData);
                      hideLoader();
                  }, 50);
                },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON, 'Error');
                        hideLoader();
                    }
                });
        });        

        $('#deenaCashGold').on('click', function(e) {
               
                showLoader();
                $.ajax({
                    url: '/api/deena-Cash-Gold',
                    type: 'get',
                    headers: {
                        'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                        'Accept': 'application/json'
                    },
                success: function(response) {
                  const table = $('#stockTable'); // <table id="stockTable"></table>
                  table.empty(); // Clear previous data

                  // If you want pretty dates:
                  const fmt = (iso) => new Date(iso).toLocaleString();

                  // Build full table (thead + tbody) with Tailwind classes
                  let html = `
                    <table id="deenaCashGoldTable" class="min-w-full border-collapse border border-gray-300">
                    <thead>
                      <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2 text-left">Serial #</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Party</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">PartyName</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">GoldStatus</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">CashStatus</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">PhoneNo</th>
                      </tr>
                    </thead>
                    <tbody>
                  `;

                  if (response.data && response.data.length) {
                    $.each(response.data, function(index, item) {
                      html += `
                        <tr class="hover:bg-gray-100">
                          <td class="border border-gray-300 px-4 py-2">${index + 1}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.party_id ?? ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.party_name ?? ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.gold_balance ?? ''}</td>
                          <td class="border border-gray-300 px-4 py-2">${(item.cash_balance ?? '')}</td>
                          <td class="border border-gray-300 px-4 py-2">${item.phone_number ?? ''}</td>
                        </tr>
                      `;
                    });
                  } else {
                    html += `
                      <tr>
                        <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">No records found.</td>
                      </tr>
                    `;
                  }

                  html += `</tbody></table>`;

                  table.html(html);
                  
                  // Initialize DataTable after DOM update (only if data exists)
                  var hasData = response.data && response.data.length > 0;
                  setTimeout(function() {
                      initDataTable('deenaCashGoldTable', hasData);
                      hideLoader();
                  }, 50);
                },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON, 'Error');
                        hideLoader();
                    }
                });
        });        

        $('#showAllRecords').on('click', function(e) {
               
                showLoader();
                $.ajax({
                    url: '/api/show-All-Records',
                    type: 'get',
                    headers: {
                        'Authorization': 'Bearer {{ session('auth_token') }}', // or get token dynamically
                        'Accept': 'application/json'
                    },
                success: function(response) {
                  const table = $('#stockTable'); // <table id="stockTable"></table>
                  table.empty(); // Clear previous data

                  
                  // If you want pretty dates:
                  const fmt = (iso) => new Date(iso).toLocaleString();

                  // Build full table (thead + tbody) with Tailwind classes
                  let html = `
                    <table id="showAllRecordsTable" class="min-w-full border-collapse border border-gray-300">
                    <thead>
                      <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2 text-left">PartNo #</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">PartyName</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Gold_In</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Gold_Out</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Gold_Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Cash_In</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Cash_Out</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Cash_Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">phone</th>
                      </tr>
                    </thead>
                    <tbody>
                  `;

                  if (response.data && response.data.length) {
                    $.each(response.data, function(index, item) {
                      html += `
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2">${item.party_id}</td>
                            <td class="border border-gray-300 px-4 py-2">${item.party_name ?? ''}</td>
                            <td class="border border-gray-300 px-4 py-2">${item.gold_received ?? ''}</td>
                            <td class="border border-gray-300 px-4 py-2">${item.gold_paid ?? ''}</td>
                            <td class="border border-gray-300 px-4 py-2">${(item.gold_balance ?? '')}</td>
                            <td class="border border-gray-300 px-4 py-2">${item.cash_received ?? ''}</td>
                            <td class="border border-gray-300 px-4 py-2">${item.cash_paid ?? ''}</td>
                            <td class="border border-gray-300 px-4 py-2">${item.cash_balance ?? ''}</td>
                            <td class="border border-gray-300 px-4 py-2">${item.phone_number ?? ''}</td>
                        </tr>
                      `;
                    });
                  } else {
                    html += `
                      <tr>
                        <td colspan="9" class="border border-gray-300 px-4 py-2 text-center">No records found.</td>
                      </tr>
                    `;
                  }

                  html += `</tbody></table>`;

                  table.html(html);
                  
                  // Initialize DataTable after DOM update (only if data exists)
                  var hasData = response.data && response.data.length > 0;
                  setTimeout(function() {
                      initDataTable('showAllRecordsTable', hasData);
                      hideLoader();
                  }, 50);

                    $('#goldLaina').val(Math.abs(response.summary.gold_positive_sum).toFixed(2));
                    $('#goldDaina').val(Math.abs(response.summary.gold_negative_sum).toFixed(2));
                    $('#cashLaina').val(Math.abs(response.summary.cash_positive_sum).toFixed(2));
                    $('#cashDaina').val(Math.abs(response.summary.cash_negative_sum).toFixed(2));

                },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON, 'Error');
                        hideLoader();
                    }
                });
        });

        function maxOrder() {
            showLoader();
            $.ajax({
                url: '/api/max-order',
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer {{ session('auth_token') }}',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    const table = $('#stockTable');
                    table.empty();

                    if (response.data && response.data.length > 0) {
                        let html = `
                            <table id="maxOrderTable" class="min-w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200 text-gray-700">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Serial #</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Party ID</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Party Name</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Order Count</th>
                                </tr>
                            </thead>
                            <tbody>
                        `;

                        response.data.forEach(function(item, index) {
                            html += `
                                <tr class="hover:bg-gray-100">
                                    <td class="border border-gray-300 px-4 py-2">${index + 1}</td>
                                    <td class="border border-gray-300 px-4 py-2">${item.party_id || '--'}</td>
                                    <td class="border border-gray-300 px-4 py-2">${item.party_name || '--'}</td>
                                    <td class="border border-gray-300 px-4 py-2">${item.order_count || 0}</td>
                                </tr>
                            `;
                        });

                        html += `</tbody></table>`;
                        table.html(html);
                        
                        // Initialize DataTable after DOM update (only if data exists)
                        setTimeout(function() {
                            initDataTable('maxOrderTable', true);
                            hideLoader();
                        }, 50);
                    } else {
                        table.html('<p class="text-red-500 px-4 py-2">No orders found.</p>');
                        // Don't initialize DataTables for empty data
                        hideLoader();
                    }
                },
                error: function(xhr) {
                    toastr.error('Error loading max order data', 'Error');
                    console.error(xhr.responseText);
                    hideLoader();
                }
            });
        }

        function maxWaste() {
            showLoader();
            $.ajax({
                url: '/api/max-waste',
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer {{ session('auth_token') }}',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    const table = $('#stockTable');
                    table.empty();

                    if (response.data && response.data.length > 0) {
                        let html = `
                            <table id="maxWasteTable" class="min-w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200 text-gray-700">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Serial #</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Party ID</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Party Name</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Total Waste Casted</th>
                                </tr>
                            </thead>
                            <tbody>
                        `;

                        response.data.forEach(function(item, index) {
                            html += `
                                <tr class="hover:bg-gray-100">
                                    <td class="border border-gray-300 px-4 py-2">${index + 1}</td>
                                    <td class="border border-gray-300 px-4 py-2">${item.party_id || '--'}</td>
                                    <td class="border border-gray-300 px-4 py-2">${item.party_name || '--'}</td>
                                    <td class="border border-gray-300 px-4 py-2">${parseFloat(item.total_waste_casted || 0).toFixed(3)}</td>
                                </tr>
                            `;
                        });

                        html += `</tbody></table>`;
                        table.html(html);
                        
                        // Initialize DataTable after DOM update (only if data exists)
                        setTimeout(function() {
                            initDataTable('maxWasteTable', true);
                            hideLoader();
                        }, 50);
                    } else {
                        table.html('<p class="text-red-500 px-4 py-2">No waste data found.</p>');
                        // Don't initialize DataTables for empty data
                        hideLoader();
                    }
                },
                error: function(xhr) {
                    toastr.error('Error loading max waste data', 'Error');
                    console.error(xhr.responseText);
                    hideLoader();
                }
            });
        }

        // Print table function
        function printTable() {
            const stockTable = $('#stockTable');
            const table = stockTable.find('table');
            
            // Check if table exists and has data
            if (table.length === 0) {
                toastr.error('Nothing to print. Please load table data first.', 'Error');
                return;
            }
            
            // Check if table has data rows (not just empty state)
            const tbody = table.find('tbody');
            const dataRows = tbody.find('tr').filter(function() {
                return !$(this).find('td[colspan]').length;
            });
            
            if (dataRows.length === 0) {
                toastr.error('Nothing to print. No data available in the table.', 'Error');
                return;
            }
            
            // Create a new window for printing
            const printWindow = window.open('', '_blank');
            
            // Get table ID to check if DataTable is initialized
            const tableId = table.attr('id');
            let tableHTML = '';
            
            // Check if DataTable is initialized on this table (guard: DataTables may not be loaded)
            if (tableId && $.fn.DataTable && $.fn.DataTable.isDataTable && $.fn.DataTable.isDataTable('#' + tableId)) {
                // Get DataTable instance
                const dataTable = $('#' + tableId).DataTable();
                
                // Get table header
                const thead = table.find('thead').html();
                
                // Get all rows from DataTable (all pages, not just current page)
                const allRows = dataTable.rows({ search: 'applied' }).nodes();
                
                // Build table with all records
                tableHTML = `
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>${thead}</thead>
                        <tbody>
                `;
                
                // Add all rows HTML
                $(allRows).each(function() {
                    const rowHTML = $(this).html();
                    tableHTML += `<tr>${rowHTML}</tr>`;
                });
                
                tableHTML += `
                        </tbody>
                    </table>
                `;
            } else {
                // If DataTable is not initialized, use original table HTML
                tableHTML = table[0].outerHTML;
            }
            
            // Create print-friendly HTML
            const printHTML = `
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Stock Table - Print</title>
                    <style>
                        @media print {
                            @page {
                                margin: 1cm;
                            }
                            body {
                                margin: 0;
                                padding: 20px;
                                font-family: Arial, sans-serif;
                            }
                        }
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 20px;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin: 20px 0;
                        }
                        th, td {
                            border: 1px solid #000;
                            padding: 8px;
                            text-align: left;
                        }
                        th {
                            background-color: #f0f0f0;
                            font-weight: bold;
                        }
                        tr:nth-child(even) {
                            background-color: #f9f9f9;
                        }
                        .print-header {
                            text-align: center;
                            margin-bottom: 20px;
                        }
                        .print-date {
                            text-align: right;
                            margin-bottom: 10px;
                            font-size: 12px;
                        }
                    </style>
                </head>
                <body>
                    <div class="print-header">
                        <h2>Stock Table Report</h2>
                    </div>
                    <div class="print-date">
                        Printed on: ${new Date().toLocaleString()}
                    </div>
                    ${tableHTML}
                    <script type="text/javascript">
                        // Close window after printing is done
                        window.addEventListener('afterprint', function() {
                            setTimeout(function() {
                                if (window && !window.closed) {
                                    window.close();
                                }
                            }, 100);
                        });
                        
                        // Fallback: close window after a delay if user cancels print
                        // This handles cases where user cancels the print dialog
                        var closeTimeout = setTimeout(function() {
                            if (window && !window.closed) {
                                // If window is still open after 3 seconds, user likely canceled
                                window.close();
                            }
                        }, 3000);
                        
                        // Clear timeout if afterprint fires (user actually printed)
                        window.addEventListener('afterprint', function() {
                            clearTimeout(closeTimeout);
                        });
                    <\/script>
                </body>
                </html>
            `;
            
            // Write to print window
            printWindow.document.write(printHTML);
            printWindow.document.close();
            
            // Wait for content to load, then trigger print dialog
            setTimeout(function() {
                printWindow.focus();
                // Trigger print dialog - user will click print from browser
                printWindow.print();
            }, 250);
        }

        // Print button click handler
        $('#printTableBtn').on('click', function() {
            printTable();
        });

    </script>
@endsection