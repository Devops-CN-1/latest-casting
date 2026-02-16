@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="w-full pt-2 px-5 bg-[#ece9d8]">
            <!-- top container start -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-10">
                <!-- left side  -->
                <div class="flex flex-col sm:flex-row items-center gap-2">
                    <label class="w-full sm:w-20 font-extrabold">PTY #:</label>
                    <input type="text" id="party_no" 
                        class="p-1 w-full sm:w-32 font-bold shadow-inner bg-yellow-100 border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" placeholder="Enter Party" />
                    <input type="text" id="party_name" readonly
                        class="p-1 w-full sm:flex-1 font-bold shadow-inner bg-yellow-100 border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                </div>

                <!-- right side  -->
                <div class="flex flex-col sm:flex-row items-center sm:gap-10">
                    <div class="w-full sm:w-2/3 flex flex-col sm:flex-row items-center gap-2">
                        <label class="w-full sm:w-10 font-bold">Date:</label>
                        <input type="text" id="currentDateTime"
                            class="p-1 w-full sm:flex-1 font-extrabold shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-yellow-100"
                            value="" />
                    </div>
                    <div class="w-full sm:w-72 flex justify-center sm:justify-end gap-5">
                        <button hidden 
                            class="mt-2 sm:mt-0 px-4 py-1 font-extrabold bg-red-600 border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Delete</button>
                        <button hidden 
                            class="mt-2 sm:mt-0 px-4 py-1 font-extrabold bg-red-600 border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Delete
                            All</button>
                    </div>
                </div>
            </div>

            <!-- table container start  -->
            <div class="flex flex-col sm:flex-row gap-5 mt-5">
                <!-- left container  -->
                <div id="party_detail" class="w-full h-60 overflow-y-auto border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white bg-[#808080]">
                    
                </div>

                <!-- right container -->
                <div class="sm:w-44 max-h-60 px-2 overflow-y-auto bg-green-100 border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white">
                    <ul class="list-none font-medium" id="walkInFreeCustomers">
                        
                    </ul>
                </div>
            </div>

            <!-- Input Sections -->
            <div class="flex items-center gap-4 mt-5">
                <div class="w-1/4 xl:w-1/5 flex flex-col items-end gap-1">
                    <div class="w-9/12 xl:w-4/5 flex flex-col">
                        <label class="font-semibold">Gold Received</label>
                        <input type="text" id="gold-received" readonly
                            class="w-full p-1 outline-none bg-yellow-100 shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                    </div>
                    <div class="w-full flex gap-2 items-center justify-end">
                        <label class="font-semibold">Laina:</label>
                        <input type="text" id="gold-laina" readonly
                            class="w-9/12 xl:w-4/5 p-1 outline-none bg-red-200 shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                    </div>
                </div>
                <div class="w-1/4 xl:w-1/5 flex flex-col items-end gap-1">
                    <div class="w-9/12 xl:w-4/5 flex flex-col">
                        <label class="font-semibold">Gold Paid</label>
                        <input type="text" id="gold-paid" readonly
                            class="w-full p-1 outline-none bg-yellow-100 shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                    </div>
                    <div class="w-full flex gap-2 items-center justify-end">
                        <label class="font-semibold">Daina:</label>
                        <input type="text" id="gold-daina" readonly
                            class="w-9/12 xl:w-4/5 p-1 outline-none bg-red-200 shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                    </div>
                </div>
                <div class="w-1/4 xl:w-[30%] flex flex-col items-end gap-1">
                    <div class="w-9/12 xl:w-4/5 flex flex-col">
                        <label class="font-semibold">Cash Received</label>
                        <input type="text" id="cash-received" readonly
                            class="w-full p-1 outline-none bg-yellow-100 shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                    </div>
                    <div class="w-full flex gap-2 items-center justify-end">
                        <label class="font-semibold">Laina:</label>
                        <input type="text" id="cash-laina" readonly
                            class="w-9/12 xl:w-4/5 p-1 outline-none bg-red-200 shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                    </div>
                </div>
                <div class="w-1/4 xl:w-[30%] flex flex-col items-end gap-1">
                    <div class="w-9/12 xl:w-4/5 flex flex-col">
                        <label class="font-semibold">Cash Paid</label>
                        <input type="text" id="cash-paid" readonly
                            class="w-full p-1 outline-none bg-yellow-100 shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                    </div>
                    <div class="w-full flex gap-2 items-center justify-end">
                        <label class="font-semibold">Daina:</label>
                        <input type="text" id="cash-daina" readonly
                            class="w-9/12 xl:w-4/5 p-1 outline-none bg-red-200 shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                    </div>
                </div>
            </div>

            <!-- Transaction Info -->
            <div class="w-full flex items-center gap-5">
                <!-- left side  -->
           
                <div class="w-8/12 mt-2">
                <form id="party-advance-form">
                    <input type="text" hidden name="partyId" id="partyId">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                        <label class="w-14 font-extrabold">Gold :</label>
                        <input type="number" id="gold" name="gold" 
                            class="w-full sm:flex-1 p-2 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                        <select id="gold-in-out" name="gold_in_out" 
                            class="sm:w-1/3 p-2 col-span-1 font-extrabold outline-none  bg-yellow-100 text-red-600 shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white">
                            <option value="Received">Received</option>
                            <option value="Paid">Paid</option>
                        </select>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 mt-2">
                        <label class="w-14 font-extrabold">Cash :</label>
                        <input type="number" id="cash" name="cash" 
                            class="w-full sm:flex-1 p-2 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                        <select id="cash-in-out"  name="cash_in_out" 
                            class="sm:w-1/3 p-2 col-span-1 font-extrabold outline-none  bg-yellow-100 text-red-600 shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white">
                            <option value="Received">Received</option>
                            <option value="Paid">Paid</option>
                        </select>
                    </div>
                    <div class="mt-2 flex flex-col md:flex-row gap-2">
                        <div class="md:w-9/12 md:flex gap-2 items-center">
                            <label class="w-14 font-extrabold">Gold Rate</label>
                            <input type="number" id="goldRate" name="goldrate" 
                                class="w-full sm:flex-1 p-2 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                        </div>
                        <div class="md:w-1/2 md:flex gap-2 items-center">
                            <label class="font-extrabold">Gold N</label>
                            <input type="number" id="goldN" name="goldN" 
                                class="w-full sm:flex-1 p-2 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                        </div>
                    </div>
                    <div class="mt-2 md:flex gap-2 items-center">
                        <label class="font-extrabold">Hawala</label>
                        <input type="text" id="hawala" name="hawala" 
                            class="w-full sm:flex-1 p-2 outline-none shadow-inner border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white" />
                    </div>
                </form>
                    <div class="w-1/2 mt-2 py-8 text-lg bg-green-200 text-center">{{ $systemSettings->software_name }}</div>

                </div>
            

                <!-- right side  -->
                <div class="w-4/12 mx-auto mt-2">
                    <div class="flex flex-col md:flex-row gap-6">

                        <!-- Left Panel -->
                        <div class="w-full md:w-2/3">
                            <div class="flex gap-5 justify-end">

                                <!-- Save & Print -->
                                <div>
                                    <div class="flex justify-end h-10">
                                        <button id="save-party-advance" 
                                            class="py-2 px-8 font-bold bg-red-600 border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Save</button>
                                    </div>
                                    <div class="mt-2 flex justify-end h-10">
                                        <button onclick="printdata()" 
                                            class="py-2 px-8 font-bold bg-purple-300 border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Print</button>
                                    </div>
                                </div>

                                <!-- Walkin + Gold Rate -->
                                <div class="w-28">
                                    <p class="text-sm font-semibold">Walkin Customers</p>
                                    <div class="mt-1">
                                        <label class="text-base font-bold block mb-1">Gold Rate</label>
                                        <input type="text" id="gold_rate_current" value="{{ $systemSettings->gold_rate }}"
                                            class="w-full text-center font-bold text-xl p-1 outline-none bg-red-200 border border-black shadow-inner" />
                                    </div>
                                </div>
                            </div>

                            <!-- Back & Clear Buttons -->
                            <div class="flex gap-2">
                                <div class="w-full flex">
                                    <a href="{{ url('/') }}"
                                        class="sm:flex-1 py-4 px-6 font-bold bg-red-600 border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Back</a>
                                </div>
                                <div class="w-full flex items-end">
                                    <button id="clear_button" 
                                        class="sm:flex-1 py-2 px-6 font-bold bg-orange-300 border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Clear</button>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <div class="w-full flex">
                                    <a href = "{{route('party.create.form')}}" ><button class="sm:flex-1 py-2 px-6 font-bold bg-green-100 border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Parties</button></a>
                                </div>
                            </div>
                        </div>

                        <!-- Number List -->
                        <div class="w-full md:w-1/3 flex items-center">
                            <div class="px-2 overflow-y-scroll h-60 w-full shadow-inner bg-green-200 border-2 border-l-[#b1b0aa] border-t-[#c9c8c4] border-r-white border-b-white">
                                <ul class="list-none font-medium" id="walkInnotFreeCustomers">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
<!-- DataTables CSS (local for offline) -->
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<!-- DataTables JS (local for offline) -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<style>
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
        textarea,
        select {
            color: #000000 !important;
        }

        /* Ensure input placeholder text is visible in dark mode */
        input[type="text"]::placeholder,
        input[type="number"]::placeholder,
        input[type="email"]::placeholder,
        input[type="password"]::placeholder,
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

        /* Force headings, p, a, and span tag text to black in dark mode */
        h1:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
        h2:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
        h3:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
        h4:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
        h5:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
        h6:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
        p:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
        a:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
        span:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]) {
            color: #000000 !important;
        }

        /* Override white and cream colors for headings, p, a, and span tags in dark mode */
        h1[class*="text-white"],
        h2[class*="text-white"],
        h3[class*="text-white"],
        h4[class*="text-white"],
        h5[class*="text-white"],
        h6[class*="text-white"],
        p[class*="text-white"],
        a[class*="text-white"],
        span[class*="text-white"],
        h1[class*="text-cream"],
        h2[class*="text-cream"],
        h3[class*="text-cream"],
        h4[class*="text-cream"],
        h5[class*="text-cream"],
        h6[class*="text-cream"],
        p[class*="text-cream"],
        a[class*="text-cream"],
        span[class*="text-cream"],
        h1[style*="color: white"],
        h2[style*="color: white"],
        h3[style*="color: white"],
        h4[style*="color: white"],
        h5[style*="color: white"],
        h6[style*="color: white"],
        p[style*="color: white"],
        a[style*="color: white"],
        span[style*="color: white"],
        h1[style*="color: #fff"],
        h2[style*="color: #fff"],
        h3[style*="color: #fff"],
        h4[style*="color: #fff"],
        h5[style*="color: #fff"],
        h6[style*="color: #fff"],
        p[style*="color: #fff"],
        a[style*="color: #fff"],
        span[style*="color: #fff"],
        h1[style*="color: #ffffff"],
        h2[style*="color: #ffffff"],
        h3[style*="color: #ffffff"],
        h4[style*="color: #ffffff"],
        h5[style*="color: #ffffff"],
        h6[style*="color: #ffffff"],
        p[style*="color: #ffffff"],
        a[style*="color: #ffffff"],
        span[style*="color: #ffffff"],
        h1[style*="color: #fefefe"],
        h2[style*="color: #fefefe"],
        h3[style*="color: #fefefe"],
        h4[style*="color: #fefefe"],
        h5[style*="color: #fefefe"],
        h6[style*="color: #fefefe"],
        p[style*="color: #fefefe"],
        a[style*="color: #fefefe"],
        span[style*="color: #fefefe"],
        h1[style*="color: #f5f5f5"],
        h2[style*="color: #f5f5f5"],
        h3[style*="color: #f5f5f5"],
        h4[style*="color: #f5f5f5"],
        h5[style*="color: #f5f5f5"],
        h6[style*="color: #f5f5f5"],
        p[style*="color: #f5f5f5"],
        a[style*="color: #f5f5f5"],
        span[style*="color: #f5f5f5"] {
            color: #000000 !important;
        }

        /* Force div, li, ul, and option text to black in dark mode */
        div:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]):not([class*="bg-"]),
        li:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
        ul:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
        option:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]) {
            color: #000000 !important;
        }

        /* Override white and cream colors for div, li, ul, and option in dark mode */
        div[class*="text-white"],
        li[class*="text-white"],
        ul[class*="text-white"],
        option[class*="text-white"],
        div[class*="text-cream"],
        li[class*="text-cream"],
        ul[class*="text-cream"],
        option[class*="text-cream"],
        div[style*="color: white"],
        div[style*="color: #fff"],
        div[style*="color: #ffffff"],
        div[style*="color: #fefefe"],
        div[style*="color: #f5f5f5"],
        li[style*="color: white"],
        li[style*="color: #fff"],
        li[style*="color: #ffffff"],
        li[style*="color: #fefefe"],
        li[style*="color: #f5f5f5"],
        ul[style*="color: white"],
        ul[style*="color: #fff"],
        ul[style*="color: #ffffff"],
        ul[style*="color: #fefefe"],
        ul[style*="color: #f5f5f5"],
        option[style*="color: white"],
        option[style*="color: #fff"],
        option[style*="color: #ffffff"],
        option[style*="color: #fefefe"],
        option[style*="color: #f5f5f5"] {
            color: #000000 !important;
        }
    }
</style>
<script>
    function printdata() {
    // Get party information
    var partyNo = $('#party_no').val() || '';
    var partyName = $('#party_name').val() || '';
    var currentDateTime = $('#currentDateTime').val() || '';
    var goldRate = $('#gold_rate_current').val() || '0';

    
    
    // Check if party is selected
    if (!partyNo) {
        toastr.error('Please select a party first.', 'Error');
        return;
    }
    
    // Get rate information
    var rateTolla = parseFloat(goldRate) ;
     let rateGram = rateTolla / 11.664 || 0; 
    
    // Extract table data from party_detail
    var tableRows = [];
    var totalGold = 0;
    var totalCash = 0;
    var firstEntry = null;
    var lastGoldTransaction = null; // Track last gold transaction
    var lastCashTransaction = null; // Track last cash transaction
    
    // Get ALL rows (all pages) from DataTable; if not DataTable, use all tbody tr
    var $table = $('#party_detail #advanceTable');
    var $rows = $table.length && $.fn.DataTable && $.fn.DataTable.isDataTable($table[0])
        ? $table.DataTable().rows({ page: 'all' }).nodes()
        : $table.find('tbody tr');
    
    $($rows).each(function() {
        var gold = $(this).find('td:eq(0)').text().trim();
        var cash = $(this).find('td:eq(1)').text().trim();
        var status = $(this).find('td:eq(2)').text().trim();
        var remarks = $(this).find('td:eq(3)').text().trim();
        var date = $(this).find('td:eq(4)').text().trim();
        var time = $(this).find('td:eq(5)').text().trim();
        
        // Convert gold and cash to numbers
        var goldNum = parseFloat(gold) || 0;
        var cashNum = parseFloat(cash) || 0;
        
        // Skip if both are empty or '--'
        if (gold === '--' && cash === '--') return;
        if (goldNum === 0 && cashNum === 0) return;
        
        // Determine R/P status
        var rpStatus = 'Received'; // Default to Received
        if (status === 'Paid' || status === 'paid') {
            rpStatus = 'Paid';
        }
        
        // Format date and time
        var formattedDate = formatDateForReceipt(date, time);
        
        // Store first entry separately if it's the first one
        if (firstEntry === null && goldNum > 0) {
            firstEntry = {
                gold: goldNum,
                cash: cashNum,
                rp: rpStatus
            };
        }

         // Track last gold transaction
        if (goldNum > 0) {
            lastGoldTransaction = {
                gold: goldNum,
                rp: rpStatus
            };
        }
        
        // Track last cash transaction
        if (cashNum > 0) {
            lastCashTransaction = {
                cash: cashNum,
                rp: rpStatus
            };
        }
        
        // Add to table rows
        tableRows.push({
            gold: goldNum,
            cash: cashNum,
            rp: rpStatus,
            remarks: remarks || 'h',
            datetime: formattedDate
        });
        
        // Calculate totals
        if (status === 'Received' || status === 'received') {
            totalGold -= goldNum;
            totalCash -= cashNum;
        } else if (status === 'Paid' || status === 'paid') {
            totalGold += goldNum;
            totalCash += cashNum;
        }
    });
    
    // Format current date/time for receipt
    var now = new Date();
    var receiptDate = formatDateTimeForReceipt(now);
    
    // Build receipt HTML
    var receiptHTML = buildReceiptHTML({
        partyNo: partyNo,
        partyName: partyName,
        dateTime: receiptDate,
        rateTolla: rateTolla.toFixed(0),
        rateGram: rateGram.toFixed(3),
        firstEntry: firstEntry,
        tableRows: tableRows,
        totalGold: totalGold.toFixed(3),
        totalCash: totalCash.toFixed(3),
        goldRate: goldRate || '0',
        lastGoldTransaction: lastGoldTransaction,
        lastCashTransaction: lastCashTransaction
    });
    
    // Open print window
    var printWindow = window.open('width=300,height=600');
    printWindow.document.write(receiptHTML);
    printWindow.document.close();
    
    // Wait for content to load, then print
    setTimeout(function() {
        printWindow.focus();
        printWindow.print();
    }, 250);
}

// Format date for receipt (dd/mm/yy HH:MM)
function formatDateForReceipt(dateStr, timeStr) {
    try {
        var date = new Date(dateStr);
        if (isNaN(date.getTime())) {
            // Try parsing different formats
            var parts = dateStr.split('/');
            if (parts.length === 3) {
                date = new Date(parts[2], parts[0] - 1, parts[1]);
            } else {
                // Try MM/DD/YYYY format
                parts = dateStr.split('/');
                if (parts.length === 3) {
                    date = new Date(parts[2], parts[0] - 1, parts[1]);
                }
            }
        }
        
        var day = String(date.getDate()).padStart(2, '0');
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var year = String(date.getFullYear()).slice(-2);
        
        // Parse time
        var hours = 0;
        var minutes = 0;
        if (timeStr) {
            var timeParts = timeStr.split(':');
            hours = parseInt(timeParts[0]) || 0;
            minutes = parseInt(timeParts[1]) || 0;
        }
        
        var period = hours >= 12 ? 'P' : 'A';
        var displayHours = hours > 12 ? hours - 12 : (hours === 0 ? 12 : hours);
        
        return day + '/' + month + '/' + year + ' ' + String(displayHours).padStart(2, '0') + ':' + String(minutes).padStart(2, '0');
    } catch (e) {
        return dateStr + ' ' + timeStr;
    }
}

// Format current date/time for receipt header
function formatDateTimeForReceipt(date) {
    var day = String(date.getDate()).padStart(2, '0');
    var month = String(date.getMonth() + 1).padStart(2, '0');
    var year = String(date.getFullYear()).slice(-2);
    var hours = date.getHours();
    var minutes = String(date.getMinutes()).padStart(2, '0');
    var period = hours >= 12 ? 'P' : 'A';
    var displayHours = hours > 12 ? hours - 12 : (hours === 0 ? 12 : hours);
    
    return day + '/' + month + '/' + year + ' ' + String(displayHours).padStart(2, '0') + ':' + minutes + ' ' + period;
}

// Build receipt HTML
function buildReceiptHTML(data) {

     var lastGold = '0';
    var lastCash = '0';
    var lastGoldRp = 'R';
    var lastCashRp = 'R';
    
    if (data.lastGoldTransaction) {
        lastGold = data.lastGoldTransaction.gold.toFixed(3);
        lastGoldRp = data.lastGoldTransaction.rp || 'R';
    }
    
    if (data.lastCashTransaction) {
        lastCash = data.lastCashTransaction.cash.toFixed(3);
        lastCashRp = data.lastCashTransaction.rp || 'R';
    }

    var html = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $systemSettings->software_name}} - Receipt Print</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @media print {
            @page {
                size: 80mm auto;
                margin: 0;
            }
            
            body {
                width: 80mm;
                margin: 0;
                padding: 5mm;
                font-family: 'Courier New', monospace;
                font-size: 10pt;
                background: white;
            }
        }

        body {
            width: 80mm;
            margin: 0 auto;
            padding: 5mm;
            font-family: 'Courier New', monospace;
            font-size: 10pt;
            background: white;
        }

        .receipt {
            width: 100%;
            max-width: 80mm;
        }

        .header {
            text-align: center;
            margin-bottom: 8px;
        }

        .decorative-line {
            text-align: center;
            font-size: 8pt;
            margin-bottom: 4px;
            letter-spacing: 2px;
        }

        .company-name {
            font-size: 14pt;
            font-weight: bold;
            margin: 4px 0;
            letter-spacing: 1px;
        }

        .company-subtitle {
            font-size: 10pt;
            margin-bottom: 8px;
        }

        .receipt-info {
            margin: 8px 0;
            line-height: 1.4;
        }

        .receipt-info div {
            margin: 2px 0;
        }

        .customer-name {
            font-weight: bold;
            margin: 4px 0;
        }

        .rate-info {
            margin: 6px 0;
            line-height: 1.5;
        }

        .table-header {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            padding: 4px 0;
            margin: 8px 0 4px 0;
            font-weight: bold;
            display: grid;
            grid-template-columns: 1fr 1fr 0.8fr 1fr 1.2fr;
            gap: 2px;
            font-size: 9pt;
        }

        .table-row {
            display: grid;
            grid-template-columns: 1fr 1fr 0.8fr 1fr 1.2fr;
            gap: 2px;
            padding: 2px 0;
            font-size: 9pt;
            line-height: 1.3;
        }

        .table-row:nth-child(even) {
            background-color: #f5f5f5;
        }

        .col-gold {
            text-align: right;
        }

        .col-cash {
            text-align: right;
        }

        .col-rp {
            text-align: center;
        }

        .col-remarks {
            font-size: 8pt;
        }

        .col-datetime {
            font-size: 8pt;
        }

        .p-rate {
            margin: 4px 0;
            font-size: 9pt;
        }

        .total {
            border-top: 1px dashed #000;
            margin-top: 8px;
            padding-top: 6px;
            font-weight: bold;
            font-size: 11pt;
            text-align: right;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 8pt;
            border-top: 1px dashed #000;
            padding-top: 8px;
        }

        @media screen {
            body {
                background: #f0f0f0;
                padding: 20px;
            }
            
            .receipt {
                background: white;
                padding: 4mm;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <div class="decorative-line">◉◉◉◉◉◉◉◉◉◉</div>
            <div class="company-name">{{ $systemSettings->software_name}}</div>
        </div>

        <div class="receipt-info">
            <div>Party code ${data.partyNo}</div>
            <div>${data.dateTime}</div>
            <div class="customer-name">Customer Name ${data.partyName.toUpperCase()}</div>
        </div>

        <div class="rate-info">
            <div>Rate/Tolla ${data.rateTolla}</div>
            <div>Rate/Gram ${data.rateGram}</div>
        </div>



        <div class="rate-info">
            P/Rate: ${lastGold} ${lastGoldRp} Cash ${lastCash} ${lastCashRp}
        </div>

        <div class="table-header">
            <div>Gold</div>
            <div>Cash</div>
            <div>R/P</div>
            <div>Remarks</div>
            <div>DateTime</div>
        </div>`;

    // Add first entry if exists
    if (data.firstEntry) {
        html += ``;
    }

    // Add table rows
    data.tableRows.forEach(function(row, index) {
        var goldStr = row.gold > 0 ? row.gold.toFixed(3) : '0';
        var cashStr = row.cash > 0 ? row.cash.toFixed(0) : '0';
        var remarks = row.remarks || 'h';
        var datetime = row.datetime || '';
        
        html += `
        <div class="table-row">
            <div class="col-gold">${goldStr}</div>
            <div class="col-cash">${cashStr}</div>
            <div class="col-rp">${row.rp}</div>
            <div class="col-remarks">${remarks}</div>
            <div class="col-datetime">${datetime}</div>
        </div>`;
    });



       html += `

        <div class="total">
            Gold ${data.totalGold} Cash ${data.totalCash}
        </div>

        <div class="footer">
            Thank you for your business!
        </div>
    </div>
    <script type="text/javascript">`;

    // Add script to close window after printing (using string concatenation to avoid template literal issues)
    html += 'window.addEventListener("afterprint", function() {';
    html += '    setTimeout(function() {';
    html += '        if (window && !window.closed) {';
    html += '            window.close();';
    html += '        }';
    html += '    }, 100);';
    html += '});';
    html += 'setTimeout(function() {';
    html += '    if (window && !window.closed) {';
    html += '        window.close();';
    html += '    }';
    html += '}, 2000);';
    html += '<\/script></body></html>';

    return html;
}

// Helper function to pad string to the right
function padRight(str, length) {
    str = String(str);
    while (str.length < length) {
        str += ' ';
    }
    return str;
}

$(document).ready(function() {




    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "timeOut": 2000, // 3 seconds
        "extendedTimeOut": 1000 // optional
    };

    function updateDateTime() {
            var now = new Date();
            var dateTime = now.toLocaleString(); // Format: MM/DD/YYYY, HH:MM:SS
            $('#currentDateTime').val(dateTime);
        }

        updateDateTime(); // Show immediately
       
        setInterval(updateDateTime, 1000); // Update every second

         getPartiesStatus();


         function getPartiesStatus() {


            $.ajax({
        url: '/api/get-parties-status', // API endpoint with dynamic party number
        type: 'GET', // HTTP method
        dataType: 'json', // Expected response type
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer {{ session('auth_token') }}"); 
            // Replace with actual token if needed
        },
        success: function(response) {
            let freeUsers = response.free_users || [];
            let nonFreeUsers = response.non_free_users || [];

            // Populate Free Customers List
            let freeCustomerList = $("#walkInFreeCustomers");
            freeCustomerList.empty(); // Clear previous list
            let walkInnotFreeCustomers = $("#walkInnotFreeCustomers");
            walkInnotFreeCustomers.empty(); // Clear previous list

            if (freeUsers.length > 0) {
                freeUsers.forEach(function(user) {

                    freeCustomerList.append(`
                        <li class="py-2 border-b border-gray-300 flex justify-between">
                            <input type="text" class="free-customer-input cursor-pointer" value="${user.partyID}" readonly>
                        </li>`);
                });
            } else {
                freeCustomerList.append(`<li class="py-2 text-gray-500">No free customers found</li>`);
            }

            if(nonFreeUsers.length > 0) {
                nonFreeUsers.forEach(function(user) {
                    
                    walkInnotFreeCustomers.append(`
                        <li class="py-2 border-b border-gray-300 flex justify-between">
                            <input type="text" class="free-customer-input cursor-pointer" value="${user.partyID}" readonly>
                        </li>`);
                });
            }else{
                walkInnotFreeCustomers.append(`<li class="py-2 text-gray-500">No customers found</li>`);
            }


        },
        error: function(xhr, status, error) {
            toastr.error( status, error, 'Error');
            // Handle the error response here
        }
    });

         }

        


    $('#party_no').keypress(function(e) {
        if (e.which === 13) { // Enter key
            var partyNo = $(this).val().trim();
            if (!partyNo) {
                toastr.error('Please enter a party number.', 'Error');
                return;
            }
            fetchCustomerData(partyNo);
            $('#gold').focus();
        }
    });

    $(document).on('click', '.free-customer-input', function() {
        let partyNo = $(this).val();
        
            fetchCustomerData(partyNo);
    }); 
    $(document).on('click', '#clear_button', function() {
    $('#party-advance-form')[0].reset();

    });

    $('#goldRate').on('keydown', function(e) {
            if (e.which === 13 || e.which === 9) { 
            var cash = parseFloat($('#cash').val()) || 0;
            var goldRate = parseFloat($('#goldRate').val()) || 1;
            var gold = (cash * 11.664) / goldRate;
            gold = gold.toFixed(3);
            $('#goldN').val(gold);
            }
    });
    $('#goldN').on('keydown', function(e) {
            if (e.which === 13 || e.which === 9) { 
            var goldN = parseFloat($('#goldN').val()) || 0;
            var goldRate = parseFloat($('#goldRate').val()) || 1;
            var cash = (goldN * goldRate) / 11.664;
            cash = cash.toFixed(3);
            $('#cash').val(cash);
            }
    });

    function fetchCustomerData(partyNo){
        $.ajax({
                url: '/api/parties/' + partyNo, // Your API route
                type: 'GET',
                dataType: 'json',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer {{ session('auth_token') }}"); // Replace with actual token if needed
                },
                success: function(response) {

                   if(response.response_code === 200){



                    let partGoldAccounDetail = response.data.gold_summary;
                    let partyCashAccounDetail = response.data.cash_summary;
                    let accountDetails = response.data.account_details || [];
                    
                    // Destroy existing DataTable if it exists (guard: DataTables may not be loaded)
                    if ($.fn.DataTable && $.fn.DataTable.isDataTable && $.fn.DataTable.isDataTable('#advanceTable')) {
                        $('#advanceTable').DataTable().destroy();
                    }
                    
                    let table = `<table id="advanceTable" class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="border border-gray-300 px-4 py-2 text-left">Gold</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Cash</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Remarks</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Time</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Party ID</th>
                            </tr>
                        </thead>
                        <tbody>`;

                    accountDetails.forEach(function(item) {
                        let gold = item.type === 'gold' ? item.amount : '';
                        let cash = item.type === 'cash' ? item.amount : '';
                        
                        let date = new Date(item.created_at);
                        let dateStr = date.toLocaleDateString();
                        let timeStr = date.toLocaleTimeString();

                        table += `<tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2">${gold|| '--'}</td>
                            <td class="border border-gray-300 px-4 py-2">${cash|| '--'}</td>
                            <td class="border border-gray-300 px-4 py-2">${item.status || ''}</td>
                            <td class="border border-gray-300 px-4 py-2">${item.remarks || ''}</td>
                            <td class="border border-gray-300 px-4 py-2">${dateStr}</td>
                            <td class="border border-gray-300 px-4 py-2">${timeStr}</td>
                            <td class="border border-gray-300 px-4 py-2">${item.party_id}</td>
                        </tr>`;
                    });

                    if (response.data.party_type === "cash") {
                        $("#party_name").val("Cash Party");
                    } else {
                        var pr = response.data.party_regular;
                        $("#party_name").val(pr ? (pr.businessName || pr.partyName || "—") : "—");
                    }

                    table += `</tbody></table>`;

                    $('#party_detail').html(table); // Replace with your div ID
                    
                    // Initialize DataTable with search and filtering (only if DataTables is loaded)
                    if ($.fn.DataTable) {
                        $('#advanceTable').DataTable({
                            "pageLength": 10,
                            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                            "order": [[4, "desc"]], // Sort by Date descending
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

                    $('#partyId').val(partyNo);
                    $('#party_no').val(partyNo);

                    $("#cash-paid").val(partyCashAccounDetail.paid);
                    $("#cash-received").val(partyCashAccounDetail.received); 
                    $("#gold-paid").val(partGoldAccounDetail.paid); 
                    $("#gold-received").val(partGoldAccounDetail.received);

                        // Ensure values are valid numbers
                var cashReceived = parseFloat(partyCashAccounDetail.received) || 0;
                var cashPaid = parseFloat(partyCashAccounDetail.paid) || 0;
                var goldReceived = parseFloat(partGoldAccounDetail.received) || 0;
                var goldPaid = parseFloat(partGoldAccounDetail.paid) || 0;

                // Calculate differences
                var cashDiff =  cashPaid - cashReceived;
                var goldDiff =  goldPaid - goldReceived;

                // For cash difference
                if (cashDiff < 0) {
                    $("#cash-laina").val(0.00);
                    $("#cash-daina").val(cashDiff.toFixed(2));
                    
                } else {
                    $("#cash-laina").val(Math.abs(cashDiff).toFixed(2)); // Show positive value with 2 decimals
                    $("#cash-daina").val(0.00);
                    
                }


                // For gold difference
                if (goldDiff < 0) {

                    $("#gold-laina").val(0);
                    $("#gold-daina").val(goldDiff);
                    
                } else {
                    

                    $("#gold-laina").val(Math.abs(goldDiff)); // Show positive value
                    $("#gold-daina").val(0);
                }
            }else{
                toastr.error('party not found', 'Error');
                

            }

                },
                error: function(xhr) {
                    toastr.error(xhr.responseText, 'Error');
                }
            });
    }

    // Enter key navigation for party-advance-form: gold → gold-in-out → cash → cash-in-out → hawala → save button
    $('#party-advance-form').on('keydown', '#gold', function (e) {
        if (e.which === 13) { e.preventDefault(); $('#gold-in-out').focus(); }
    });
    $('#party-advance-form').on('keydown', '#gold-in-out', function (e) {
        if (e.which === 13) { e.preventDefault(); $('#cash').focus(); }
    });
    $('#party-advance-form').on('keydown', '#cash', function (e) {
        if (e.which === 13) { e.preventDefault(); $('#cash-in-out').focus(); }
    });
    $('#party-advance-form').on('keydown', '#cash-in-out', function (e) {
        if (e.which === 13) { e.preventDefault(); $('#hawala').focus(); }
    });
    $('#party-advance-form').on('keydown', '#hawala', function (e) {
        if (e.which === 13) { e.preventDefault(); $('#save-party-advance').focus(); }
    });
    $('#save-party-advance').on('keydown', function (e) {
        if (e.which === 13) { e.preventDefault(); $(this).click(); }
    });

    $('#save-party-advance').on('click', function (e) {
        e.preventDefault();

        if ($(this).prop('disabled')) return;

        let gold = $('#gold').val().trim();
        let cash = $('#cash').val().trim();
        let hawala = $('#hawala').val().trim();

        // Check if at least one of Gold or Cash has a value
        if ((gold === '' || parseFloat(gold) === 0) && (cash === '' || parseFloat(cash) === 0)) {
             toastr.error('Please enter a value in either Gold or Cash.', 'Error');
            return false;
        }

        // Check if Hawala has a value
        if (hawala === '') {
            toastr.error('Hawala is required.', 'Error');
            return false;
        }

        let $btn = $(this);
        $btn.prop('disabled', true);

        let formData = $('#party-advance-form').serialize();
        $.ajax({

            url: '/api/store-party-advance',
            type: 'POST',
            data: formData,
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer {{ session('auth_token') }}' // if API requires authentication
            },
            success: function (response) {

                $('#party-advance-form')[0].reset();
                $('#party_no').val('');
                $('#party_name').val('');
                $('#gold-received').val('');
                $('#gold-laina').val('');
                $('#gold-paid').val('');
                $('#gold-daina').val('');
                $('#cash-received').val('');
                $('#cash-laina').val('');
                $('#cash-paid').val('');
                $('#cash-daina').val('');
                getPartiesStatus();
                // fetchCustomerData('');
                toastr.success('Party saved successfully!', 'Success');
            },
            error: function (xhr) {
                toastr.error(xhr.responseText, 'Error');
            },
            complete: function () {
                $btn.prop('disabled', false);
            }
        });
    });


});





</script>
@endsection