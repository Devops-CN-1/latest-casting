@extends('layouts.app')

@section('content')
<div class="container mx-auto">
        <div class="w-full pt-2 bg-[#ece9d8]">
            <!-- table container  -->
            <div id="party-container" class="h-60 overflow-y-auto border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#808080]">
                
            </div>
            <!-- form container  -->
            <div class="mt-2">
                <div class="w-full flex items-center gap-3">
                    <div class="w-1/3 block sm:flex items-center gap-3">
                        <label class="shrink-0 w-28 text-right font-semibold text-[#1e1ec2]">Party No:</label>
                        <input type="number" id="newPartyId" 
                            class="min-w-0 flex-1 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white"
                            value="{{$nextPartyNumber}}" />
                        <button id="save-cash-party" type="button" class="mt-2 sm:mt-0 px-4 py-1 font-semibold bg-[#ff80ff] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] cursor-pointer">Cash</button>
                    </div>
                    <div class="w-1/3 block sm:flex gap-3 items-center">
                        <label class="shrink-0 w-28 py-1 text-center font-semibold bg-[#ff8080]">Party No:</label>
                        <input type="number" id="party_no"  value="" 
                            class="min-w-0 flex-1 p-1 outline-none shadow-inner border-2 bg-[#ff8080] border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                        <button id="search_party" class="px-5 py-1 font-semibold bg-[#ff8080] border-2 border-l-white border-t-white border-r-[#b1b0aa] border-b-[#c9c8c4] cursor-pointer">Search</button>
                    </div>
                </div>
                <input type="text" id="party_no_for_update_party" name="party_no_for_update_party" hidden value="">

                <!-- input fields  -->
                <form id="party-form">
                    <div class="mt-5">
                    <input type="hidden" id="main_party_no" name="main_party_no" value="{{$nextPartyNumber}}" />
                        <!-- column 1 -->
                        <div class="w-full flex gap-3">
                            <div class="w-1/3 sm:flex gap-3 items-center">
                                <label class="shrink-0 w-28 text-right font-semibold text-[#1e1ec2]" >Name:</label>
                                <input type="text" name="partyName" id="partyName" value="" 
                                    class="min-w-0 flex-1 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" required />
                            </div>
                            <div class="w-1/3 sm:flex gap-3 items-center">
                                <label class="shrink-0 w-28 text-right font-semibold text-[#1e1ec2]" >Ph No:</label>
                                <input type="number" name="phone" id="phone" value="" 
                                    class="min-w-0 flex-1 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" required />
                            </div>
                        </div>
                        <!-- column 2 -->
                        <div class="w-full mt-5 flex gap-3">
                            <div class="w-1/3 sm:flex gap-3 items-center">
                                <label class="shrink-0 w-28 text-right font-semibold text-[#1e1ec2]" >Biz Name:</label>
                                <input type="text" name="businessName"   id="businessName"  value="" 
                                    class="min-w-0 flex-1 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" required />
                            </div>

                            <div class="w-1/2 flex gap-3">
                                <div class="w-1/2 sm:flex gap-3 items-center">
                                    <label class="shrink-0 w-28 text-right font-semibold text-[#1e1ec2]" >Waste:</label>
                                    <input type="number"  name="wasteDiscount" id="wasteDiscount" value="" 
                                        class="min-w-0 flex-1 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                                </div>
                                <div class="w-1/2 flex items-center gap-3">
                                    <label class="shrink-0 w-28 text-right font-semibold text-[#1e1ec2]" >Waste 16</label>
                                    <input type="number"  name="wasteDiscount16" id="wasteDiscount16"  value="" 
                                        class="min-w-0 flex-1 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                                </div>


                            </div>
                        </div>

                        <!-- column 3 -->
                        <div class="w-full mt-5 flex gap-3">
                            <div class="w-1/3 flex gap-3 items-center">
                                <label class="shrink-0 w-28 text-right font-semibold text-[#1e1ec2]" >Address:</label>
                                <input type="text" name="address"  id="address"  value="" 
                                    class="min-w-0 flex-1 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" required />
                            </div>
                            <div class="w-1/2 flex gap-3">
                                <div class="w-1/2 sm:flex gap-3 items-center">
                                    <label class="shrink-0 w-28 text-right font-semibold text-[#1e1ec2]" >Mazdori:</label>
                                    <input type="number" name="mazdoriDiscount" id="mazdoriDiscount" value="" 
                                        class="min-w-0 flex-1 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                                </div>
                                <div class="w-1/2 sm:flex gap-3 items-center">
                                    <label
                                        class="whitespace-nowrap shrink-0 w-28 text-right font-semibold text-[#1e1ec2]" >Mazdori
                                        16</label>
                                    <input type="number" name="mazdooriDiscount16" id="mazdooriDiscount16" value="" 
                                        class="min-w-0 flex-1 p-1 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- buttons -->
                <div class="mt-5">
                    <div>
                        <button id="openStockModal" class="w-24 px-5 py-1 font-semibold bg-[#ffc0c0] border-2 border-l-white border-t-white border-r-[#b1b0aa] border-b-[#c9c8c4] cursor-pointer">
                            Stock
                        </button>
                        
                        <button id="save-party" type="button" class="w-24 px-5 py-1 font-semibold bg-[#ffffc0] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] cursor-pointer ">Save</button>
                        <button class="w-24 px-5 py-1 font-semibold bg-[#c0ffc0] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] cursor-pointer">Delete</button>
                        <button id="ClearForm" type="button"  class="w-24 px-5 py-1 font-semibold bg-[#c0c0ff] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] cursor-pointer">Clear</button>
                        <button id="list-btn" type="button" class="w-24 px-5 py-1 font-semibold bg-[#ffc0ff] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] cursor-pointer">List...</button>
                    </div>
                    <div class="mt-2">
                        <button class="w-24 px-5 py-1 font-semibold bg-[#c0ffff] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] cursor-pointer">Free</button>
                        <button id="edit-party" type="button" class="w-24 px-5 py-1 font-semibold bg-[#ff8080] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] cursor-pointer">Edit</button>
                        <a href="{{url('/')}}" class="w-24 px-5 py-1 font-semibold bg-[#ff00ff] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] cursor-pointer">Order</a>
                        <button class="w-24 px-5 py-1 font-semibold bg-[#c00000] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] cursor-pointer">Quit</button>
                        <button id="list-c-btn" type="button" class="w-24 py-1 px-5 font-semibold bg-[#c0c0c0] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4] cursor-pointer">List(C)</button>
                        <button id="leenaCashGold" class="w-24 text-center py-1 font-semibold border-2 border-l-white border-t-white border-r-[#b1b0aa] border-b-[#c9c8c4] bg-[#ff0000] cursor-pointer">Leena</button>
                        <button id="deenaCashGold" class="w-24 text-center py-1 font-semibold border-2 border-l-white border-t-white border-r-[#b1b0aa] border-b-[#c9c8c4] bg-[#c000c0] cursor-pointer">Deena</button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="stockModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-xl font-bold mb-4">Enter Password</h2>
                    <form id="stockPasswordForm">
                        @csrf
                        <input type="password" name="stock_password" id="stock_password" class="w-full p-2 border rounded mb-3" placeholder="Enter Stock Password">
                        <div id="error_message" class="text-red-500 text-sm mb-2"></div>
                        <div class="flex justify-end gap-3">
                            <button type="button" id="closeStockModal" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- images container  -->
            <div class="mt-2 flex">
                <!-- Image 1 Section -->
                <img src="{{asset('assets/images/makkahImage.jpg')}}" alt="Makkah Image" class="w-1/4">

                <!-- Image 2 Section -->
                <img src="{{asset('assets/images/maddinaImage.jpg')}}" alt="Maddina Image" class="w-1/4">
            </div>
        </div>
    </div>

    <!-- Loader Overlay -->
    <div id="tableLoader" class="fixed inset-0 bg-transparent z-50 hidden flex items-center justify-center">
        <div class="bg-gradient-to-br from-purple-500 to-blue-600 rounded-lg p-6 shadow-2xl flex flex-col items-center">
            <div class="loader-spinner mb-4"></div>
            <p class="text-white font-semibold text-lg">Loading data...</p>
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
            border-top: 4px solid #ffffff;
            border-right: 4px solid #ffffff;
            animation: spin 0.8s linear infinite;
        }

        .loader-spinner::after {
            width: 40px;
            height: 40px;
            top: 10px;
            left: 10px;
            border-bottom: 4px solid #f1c40f;
            border-left: 4px solid #f1c40f;
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

        /* Force input text color to black even in dark mode */
        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="password"],
        textarea {
            color: #000000 !important;
        }

        /* Ensure input text is visible in dark mode */
        input[type="text"]::placeholder,
        input[type="number"]::placeholder,
        input[type="email"]::placeholder,
        input[type="password"]::placeholder,
        textarea::placeholder {
            color: #666666 !important;
        }

        /* Force table text color to black even in dark mode */
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

        /* Force all text elements to black in dark mode */
        label,
        span:not([class*="text-"]),
        p:not([class*="text-"]),
        div:not([class*="text-"]):not([class*="bg-"]),
        h1:not([class*="text-"]), 
        h2:not([class*="text-"]), 
        h3:not([class*="text-"]), 
        h4:not([class*="text-"]), 
        h5:not([class*="text-"]), 
        h6:not([class*="text-"]) {
            color: #000000 !important;
        }

        /* Force button text to black (unless it has explicit text color class) */
        button:not([class*="text-"]) {
            color: #000000 !important;
        }

        /* Override dark mode color scheme */
        body {
            color-scheme: light !important;
        }

        /* Ensure all text in the main container is black */
        .container *:not([class*="text-"]):not([style*="color"]) {
            color: #000000 !important;
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

    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "timeOut": 2000, // 3 seconds
        "extendedTimeOut": 1000 // optional
    };

     // Show modal on button click
    $('#openStockModal').click(function () {
        $('#stockModal').removeClass('hidden');
        setTimeout(function () { $('#stock_password').focus(); }, 0);
    });

    // Close modal
    $('#closeStockModal').click(function () {
        $('#stockModal').addClass('hidden');
        $('#error_message').text('');
        $('#stock_password').val('');
    });

    // Submit form using AJAX
    $('#stockPasswordForm').submit(function (e) {
        e.preventDefault();
        let password = $('#stock_password').val();
        
        $.ajax({
            url: "{{ route('check.stock.password') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                stock_password: password
            },
            success: function (response) {
                if (response.status === 'success') {
                    window.location.href = "{{ route('stock') }}";
                } else {
                    $('#error_message').text(response.message).show();
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                $('#error_message').text('Something went wrong. Please try again later.').show();
            }
        });
    });




    $(document).ready(function () {
        // Setup CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer {{ session('auth_token') }}' // If you use API token
            }
        });

        // On clicking list button
        $('#list-btn').click(function () {
            fetchParties('regular');
        });

        // On clicking list-c button
        $('#list-c-btn').click(function () {
            fetchParties('cash');
        });

        // Destroy any DataTable inside party-container (parties, leena, deena tables)
        function destroyPartyContainerDataTable() {
            var ids = ['partiesTable', 'leenaCashGoldTable', 'deenaCashGoldTable'];
            ids.forEach(function(id) {
                var $t = $('#' + id);
                if ($t.length && $.fn.DataTable && $.fn.DataTable.isDataTable($t)) {
                    $t.DataTable().destroy();
                }
            });
        }

        function initPartyDataTable(tableId, hasData) {
            if (!hasData || !$.fn.DataTable) return;
            var $table = $('#' + tableId);
            if ($table.length) {
                $table.DataTable({
                    "pageLength": 10,
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "order": [[0, "asc"]],
                    "searching": true,
                    "paging": true,
                    "info": true,
                    "ordering": true,
                    "language": {
                        "search": "Search:",
                        "lengthMenu": "Show _MENU_ entries",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                        "infoEmpty": "Showing 0 to 0 of 0 entries",
                        "infoFiltered": "(filtered from _MAX_ total entries)",
                        "zeroRecords": "No matching records found"
                    }
                });
            }
        }

        // Leena button – same as stock: fetch leena Cash/Gold and show in table
        $('#leenaCashGold').on('click', function() {
            showLoader();
            destroyPartyContainerDataTable();
            $.ajax({
                url: '/api/leena-Cash-Gold',
                type: 'get',
                headers: {
                    'Authorization': 'Bearer {{ session('auth_token') }}',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    var table = $('#party-container');
                    table.empty();
                    var html = `
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
                                <td class="border border-gray-300 px-4 py-2">${item.cash_balance ?? ''}</td>
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
                    html += '</tbody></table>';
                    table.html(html);
                    var hasData = response.data && response.data.length > 0;
                    setTimeout(function() {
                        initPartyDataTable('leenaCashGoldTable', hasData);
                        hideLoader();
                    }, 50);
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Error loading Leena data.');
                    hideLoader();
                }
            });
        });

        // Deena button – same as stock: fetch deena Cash/Gold and show in table
        $('#deenaCashGold').on('click', function() {
            showLoader();
            destroyPartyContainerDataTable();
            $.ajax({
                url: '/api/deena-Cash-Gold',
                type: 'get',
                headers: {
                    'Authorization': 'Bearer {{ session('auth_token') }}',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    var table = $('#party-container');
                    table.empty();
                    var html = `
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
                                <td class="border border-gray-300 px-4 py-2">${item.cash_balance ?? ''}</td>
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
                    html += '</tbody></table>';
                    table.html(html);
                    var hasData = response.data && response.data.length > 0;
                    setTimeout(function() {
                        initPartyDataTable('deenaCashGoldTable', hasData);
                        hideLoader();
                    }, 50);
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Error loading Deena data.');
                    hideLoader();
                }
            });
        });

        function fetchParties(type) {
            showLoader();
            destroyPartyContainerDataTable();
            $.ajax({
                url: '/api/parties/type/' + type,
                type: 'GET',
                success: function (data) {

                    let table = `
                        <table id="partiesTable" class="min-w-full border-collapse border border-gray-300">
                            <thead>
                    `;

                    if (type === 'regular') {
                        table += `
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="border border-gray-300 px-4 py-2 text-left">Party ID</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Party Name</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Business Name</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Address</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Phone</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Waste Discount</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Mazdoori Discount</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Waste Discount 16</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Mazdoori Discount 16</th>
                            </tr>
                            </thead>
                            <tbody>
                        `;

                        $.each(data.data, function (index, party) {
                            let regular = party.party_regular || {};
                            table += `
                                <tr class="hover:bg-gray-100">
                                    <td class="border border-gray-300 px-4 py-2">${party.partyID}</td>
                                    <td class="border border-gray-300 px-4 py-2">${regular.partyName || ''}</td>
                                    <td class="border border-gray-300 px-4 py-2">${regular.businessName || ''}</td>
                                    <td class="border border-gray-300 px-4 py-2">${regular.address || ''}</td>
                                    <td class="border border-gray-300 px-4 py-2">${regular.phone || ''}</td>
                                    <td class="border border-gray-300 px-4 py-2">${regular.wasteDiscount || ''}</td>
                                    <td class="border border-gray-300 px-4 py-2">${regular.mazdoriDiscount || ''}</td>
                                    <td class="border border-gray-300 px-4 py-2">${regular.wasteDiscount16 || ''}</td>
                                    <td class="border border-gray-300 px-4 py-2">${regular.mazdooriDiscount16 || ''}</td>
                                </tr>
                            `;
                        });

                    } else if (type === 'cash') {
                        table += `
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="border border-gray-300 px-4 py-2 text-left">SR#</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">PartyId</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                        `;

                        $.each(data.data, function (index, party) {
                            table += `
                                <tr class="hover:bg-gray-100">
                                    <td class="border border-gray-300 px-4 py-2">${party.partyID}</td>
                                    <td class="border border-gray-300 px-4 py-2">${party.partyID}</td>
                                    <td class="border border-gray-300 px-4 py-2">free</td>
                                </tr>
                            `;
                        });
                    }

                    table += `</tbody></table>`;

                    $('#party-container').html(table);

                    // Initialize DataTable only if the table exists and DataTable is available
                    var $table = $('#partiesTable');
                    if ($table.length && $.fn.DataTable) {
                        $table.DataTable({
                            "pageLength": 10,
                            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                            "order": [[0, "asc"]],
                            "searching": true,
                            "paging": true,
                            "info": true,
                            "ordering": true,
                            "language": {
                                "search": "Search:",
                                "lengthMenu": "Show _MENU_ entries",
                                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                                "infoEmpty": "Showing 0 to 0 of 0 entries",
                                "infoFiltered": "(filtered from _MAX_ total entries)",
                                "zeroRecords": "No matching records found"
                            }
                        });
                    }

                    hideLoader();
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    hideLoader();
                }
            });
        }
    });

    $('#search_party').click(function() {
       
        var party_no = $('#party_no').val();
            if (party_no == '') {
                toastr.error('Please enter Party ID.', 'Error');
                return;
            }

        $.ajax({
                url: '/api/parties/' + party_no, // Your API route
                type: 'GET',
                dataType: 'json',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer {{ session('auth_token') }}"); // Replace with actual token if needed
                },
                success: function(response) {
                    if (response.status === 'error') {
                            $('#party-form')[0].reset();
                            $('#party_no_for_update_party').val('');
                            toastr.success('No Party Found.', 'Success');
                            return; // stop further execution
                        }

                    if (response.data.party_type === 'regular') {
                        let party = response.data.party_regular;

                        $('#partyName').val(party.partyName);
                        $('#businessName').val(party.businessName);
                        $('#address').val(party.address);
                        $('#phone').val(party.phone);
                        $('#wasteDiscount').val(party.wasteDiscount);
                        $('#mazdoriDiscount').val(party.mazdoriDiscount);
                        $('#wasteDiscount16').val(party.wasteDiscount16);
                        $('#mazdooriDiscount16').val(party.mazdooriDiscount16);
                        $('#party_no_for_update_party').val(party.partyID);
                    }else if(response.data.party_type === 'cash'){
                        $('#party-form')[0].reset();
                        $('#partyName').val("Cash");
                        $('#businessName').val("Free");
                        $('#party_no_for_update_party').val('');

                    }
                     else {
                        $('#party-form')[0].reset();
                        $('#party_no_for_update_party').val('');
                        toastr.success('No Party Found.', 'Success');
                    }

                   $('#save-party')
                    .attr('disabled', true)
                    .removeClass('cursor-pointer');


                    
                },
                error: function(xhr) {
                    toastr.error(xhr.responseText, 'Error');
                   
                }
        });
    });

    $('#ClearForm').on('click', function (e) {

        $('#party-form')[0].reset();
        $('#main_party_no').val($('#newPartyId').val());
        $('#save-party')
            .attr('disabled', false)
            .addClass('cursor-pointer');

    });
    // Keep Party No in sync: newPartyId is the source of truth for the party ID when creating
    $('#newPartyId').on('change input', function () {
        $('#main_party_no').val($(this).val());
    });
    $('#main_party_no').on('change input', function () {
        $('#newPartyId').val($(this).val());
    });
    $('#save-party').on('click', function (e) {



        e.preventDefault();


          let isValid = true;
            $('#party-form').find('input, select, textarea').each(function() {
                if ($(this).prop('required') && $(this).val().trim() === '') {
                    isValid = false;
                    $(this).addClass('border-red-500'); // Optional highlight
                } else {
                    $(this).removeClass('border-red-500');
                }
            });

            if (!isValid) {
                toastr.error('Please fill all required fields', 'Error');
                return false;
            }



        var type = "regular";
        var partyID = $('#newPartyId').val().trim();
        if (!partyID) {
            toastr.error('Please enter Party No.', 'Error');
            return;
        }
        let formData = $('#party-form').serialize() + '&type=' + encodeURIComponent(type) + '&partyID=' + encodeURIComponent(partyID);

        $.ajax({
            url: '/api/add-party',
            type: 'POST',
            data: formData,
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer {{ session('auth_token') }}' // if API requires authentication
            },
            success: function (response) {

                $('#party-form')[0].reset();

                let partyInput = $('#newPartyId');
                let currentVal = parseInt(partyInput.val(), 10) || 0;
                partyInput.val(currentVal + 1);
                $('#main_party_no').val(currentVal + 1);
                 toastr.success('Party saved successfully!', 'Success');

            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Party already exists.';
                    toastr.error(msg, 'Error');
                } else {
                    toastr.error(xhr.responseText || 'Error saving party.', 'Error');
                }
            }
        });
    });

    $('#save-cash-party').on('click', function (e) {
        e.preventDefault();

        var partyID = $('#newPartyId').val().trim();
        if (!partyID) {
            toastr.error('Please enter Party No.', 'Error');
            return;
        }
        var type = "cash";
        let formData = 'type=' + encodeURIComponent(type) + '&partyID=' + encodeURIComponent(partyID);

        $.ajax({
            url: '/api/add-party',
            type: 'POST',
            data: formData,
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer {{ session('auth_token') }}' // if API requires authentication
            },
            success: function (response) {

                $('#party-form')[0].reset();

                let partyInput = $('#newPartyId');
                let currentVal = parseInt(partyInput.val(), 10) || 0;
                partyInput.val(currentVal + 1);
                $('#main_party_no').val(currentVal + 1);
                toastr.success('Party saved successfully!', 'Success');
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Party already exists.';
                    toastr.error(msg, 'Error');
                } else {
                    toastr.error(xhr.responseText || 'Error saving party.', 'Error');
                }
            }
        });
    });  

    $('#edit-party').on('click', function (e) {

        var partyNoUpdate = $('#party_no_for_update_party').val().trim();
        var partyNo = $('#party_no').val().trim();

        if (partyNoUpdate === '' || partyNo === '') {

            toastr.error('Cash party cannot be updated.', 'Error');
            return;
        }

        if (partyNoUpdate !== partyNo) {
            toastr.error('Cash party cannot be updated.', 'Error');
            return;
        }


        e.preventDefault();

        var type = "regular";
        let formData = $('#party-form').serialize() + '&type=' + encodeURIComponent(type);

        $.ajax({
            url: '/api/party/' + partyNo,
            type: 'Put',
            data: formData,
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer {{ session('auth_token') }}' // if API requires authentication
            },
            success: function (response) {

                $('#party-form')[0].reset();

                let partyInput = $('#newPartyId');
                let currentVal = parseInt(partyInput.val()) || 0;
                // partyInput.val(currentVal + 1);
                toastr.success('Party saved successfully!', 'Success');
               
            },
            error: function (xhr) {
                toastr.error(xhr.responseText, 'Error');
                
            }
        });
    });



    $('#partyName').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#phone').focus();
        }
    });

    $('#phone').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#businessName').focus();
        }
    });

    $('#businessName').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#address').focus();
        }
    });

    $('#address').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#wasteDiscount').focus();
        }
    });

    $('#wasteDiscount').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#wasteDiscount16').focus();
        }
    });

    $('#wasteDiscount16').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#mazdoriDiscount').focus();
        }
    });

    $('#mazdoriDiscount').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#mazdooriDiscount16').focus();
        }
    });

    $('#mazdooriDiscount16').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#save-party').focus();
        }
    });

    $('#party_no').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#search_party').triggerHandler('click');
        }
    });

</script>

@endsection

