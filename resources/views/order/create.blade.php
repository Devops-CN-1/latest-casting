@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="w-full p-5 bg-[#004000]">
            <!-- ayat ul kursi -->
            <h1 class="text-xs font-semibold text-center text-[#cbd2a2]">
                ٱللَّهُ لَآ إِلَـٰهَ إِلَّا هُوَ ٱلْحَىُّ ٱلْقَيُّومُ ۚ لَا تَأْخُذُهُۥ سِنَةٌۭ وَلَا نَوْمٌۭ ۚ لَّهُۥ
                مَا فِى ٱلسَّمَـٰوَٰتِ وَمَا فِى ٱلْأَرْضِ ۗ مَن ذَا ٱلَّذِى يَشْفَعُ عِندَهُۥٓ إِلَّا بِإِذْنِهِۦ ۚ
                يَعْلَمُ مَا بَيْنَ أَيْدِيهِمْ وَمَا خَلْفَهُمْ ۖ وَلَا يُحِيطُونَ بِشَىْءٍۢ مِّنْ عِلْمِهِۦٓ إِلَّا
                بِمَا شَآءَ ۚ وَسِعَ كُرْسِيُّهُ ٱلسَّمَـٰوَٰتِ وَٱلْأَرْضَ ۖ وَلَا يَـُٔودُهُۥ حِفْظُهُمَا ۚ وَهُوَ
                ٱلْعَلِىُّ ٱلْعَظِيمُ ٢٥٥
            </h1>
            <div class="mt-2 w-full flex items-center gap-5">
                <div class="w-1/5 flex items-center">
                    <input type="number" name="getPartyData" id="getPartyData" 
                        class="w-full sm:flex-1 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white" />
                    <label class="ml-2 p-1 w-20 text-center font-semibold bg-[#804000] text-[#f1da69]">پارٹی
                        نمبر</label>
                </div>
                <div class="w-1/2 flex gap-5 items-center">
                    <input type="text" name="partyName" id="partyName" 
                        class="w-full sm:flex-1 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white" />
                    <label class="ml-2 p-1 w-20 text-center font-semibold bg-[#804000] text-[#f1da69]">پارٹی نام</label>
                </div>
                <div class="">
                    <button type="button" onclick="getOldParchies()" 
                        id="oldParchiBtn"
                        class="p-1 font-bold bg-[#80ff80] border-2 border-l-white border-t-white border-r-[#b1b0aa] border-b-[#c9c8c4]">
                        Old Parchi
                    </button>
                </div>
            </div>
            <!-- second input feilds column  -->
            <div class="mt-2 w-full flex items-center gap-5">
                <!-- input field -->

                <input type="number"  name="party_id" id="party_id" value="1" hidden>

                <div class="w-1/4 flex items-center">
                    <input type="number" name="weightCastig" id="weightCastig" 
                        class="w-full sm:flex-1 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                    <label class="ml-2 p-1 w-28 text-center font-semibold bg-[#000040] text-[#f1da69]">وزن
                        کاسٹنگ</label>
                </div>
                <!-- checkoxes -->
                <div class="w-1/6 flex justify-center">
                    <div
                        class="px-1 flex items-center cursor-pointer space-x-2 bg-[#800000] text-white border border-black">
                        <span class="h-8">پیس</span>
                        <input type="checkbox" id="pieceCheck" class="">
                    </div>
                    <div
                        class="px-1 flex items-center cursor-pointer space-x-2 bg-[#800000] text-white border border-black">
                        <span class="h-8">اندر</span>
                        <input type="checkbox" name="InOutCheck" id="InOutCheck" class="">
                    </div>
                </div>
                <!-- input field  -->
                <div class="w-1/4 flex items-center gap-4">
                    <input type="number" name="mailCode"  id="mailCode" 
                        class="w-full sm:flex-1 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                    <label class="ml-2 p-1 w-20 text-center font-semibold bg-[#804000] text-[#f1da69]">میل کوڈ</label>
                </div>
                <!-- input field  -->
                <div class="w-1/3 flex items-center gap-4">
                    <input type="text" name="remarks" id="remarks" 
                        class="w-full sm:flex-1 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                    <label class="ml-2 p-1 w-32 text-center font-semibold bg-[#804000] text-[#f1da69]">پارٹی بل
                        نمبر</label>
                </div>
            </div>
            <div class="mt-2 flex gap-5">
                <!-- left input types -->
                <div class="w-[30%] flex">
                    <!-- Input Fields -->
                    <div class="w-1/2 flex flex-col space-y-2 mr-2">
                        <input type="number" name="wapsiGold" id="wapsiGold" 
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="number" name="netWeight" id="netWeight"
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="number" name="wasteCasted" id="wasteCasted"  
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="number" name="totalWeight" id="totalWeight" 
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="number" name="totalWeightCasted" id="totalWeightCasted" 
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="number"name="khalis" id="khalis"  value="" 
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="number" name="advance" id="advance"  value="" 
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="number" name="totalKhalis" id="totalKhalis" 
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                    </div>

                    <!-- Labels Panel -->
                    <div class="w-1/2 flex flex-col items-center p-1 font-semibold bg-[#804000] text-[#f1da69]">
                        <span class="text-blue-100">Wapsi</span>
                        <span class="text-blue-100 mt-6">Net Weight</span>
                        <span class="mt-6">ویسٹ</span>
                        <span class="mt-6">کُل وزن</span>
                        <span class="mt-6">میل نکالا</span>
                        <span class="mt-5">خالص</span>
                        <span class="mt-5">ایڈوانس</span>
                        <span class="mt-5">کُل خالص</span>
                    </div>
                </div>
                <div class="w-[40%]">
                    <!-- center input types -->
                    <div class="flex gap-2">
                        <!-- Input Fields -->
                        <div class="w-1/3 flex">
                            <input type="number" name="anderCheckValue"  id="anderCheckValue" 
                                class="w-full h-7 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                            <input type="number" name="InOut" id="InOut"
                                class="w-full h-7 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        </div>
                        <div class="w-1/3 flex flex-col space-y-2">
                            <input type="number" name="mazdoorie"  id="mazdoorie" value="" 
                                class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                            <input type="number"  name="remainingMazdoori" id="remainingMazdoori"
                                class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                            <input type="number" name="totalMazdoori" id="totalMazdoori" 
                                class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        </div>

                        <!-- Labels Panel -->
                        <div class="text-center bg-[#800000] text-[#f1da69] font-semibold w-1/3">
                            <span class="block">مزدوری</span>
                            <span class="mt-2 block">سابقہ مزدوری</span>
                            <span class="mt-2 block">کُل مزدوری</span>
                        </div>
                    </div>
                    <div class="mt-2 flex justify-center items-center">
                        <img src="{{asset('assets/images/makkahmadina.png')}}" alt="">
                    </div>
                </div>
                <div class="w-[30%]">
                    <div class="flex items-center gap-5">
                        <div class="w-3/5 space-y-2">
                            <div class="flex items-center">
                                <input type="number" name="mazdoriRate" id="mazdoriRate" value="" 
                                    class="w-1/2 h-7 bg-[#ff0000] outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                                <input type="number" name="mazdoridiscountRate" id="mazdoridiscountRate" value="18" 
                                    class="w-1/2 h-7 bg-[#ffc0c0] outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" 
                                    class="w-1/6 h-7 bg-white outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                                <input type="number" name="wasteRate" id="wasteRate" 
                                    class="w-5/12 h-7 bg-[#ff0000] outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                                <input type="number" name="wasteDiscountRate" id="wasteDiscountRate"  value="0.100" 
                                    class="w-5/12 h-7 bg-[#ffc0c0] outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                            </div>
                            <div>
                                <input type="number"  name="tollaRate" id="tollaRate"  value="{{ $systemSettings->gold_rate }}" 
                                    class="w-full h-7 bg-[#ffc0c0] outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                            </div>
                            <div>
                                <input type="number" name="gramRate" id="gramRate"  value="{{ $systemSettings->gram_rate }}" 
                                    class="w-full h-7 bg-[#ffc0c0] outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                            </div>
                        </div>

                        <div class="p-1 w-[40%] text-center bg-[#400040] text-[#f1da69] font-semibold">
                            <span class="block">مزدوری</span>
                            <span class="mt-2 block">ویسٹ</span>
                            <span class="mt-3 block"> ریٹ</span>
                            <span class="mt-3 block">گرام</span>
                        </div>
                    </div>
                    <div class="mt-2 w-full flex items-center justify-between">
                        <label class="text-white font-semibold" for="">Last Deal Party</label>
                        <input class="order-readonly-input w-1/2 outline-none shadow-inner bg-[#d8e4f8] border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white" id="lastPartyBillNo" readonly tabindex="-1" type="number">
                    </div>
                    <div class="flex items-center text-sm gap-1 mt-2">
                        <input class="order-readonly-input w-1/4 outline-none shadow-inner border-2 bg-[#ffc0ff] border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white" id="lastPartyBills" value="" readonly tabindex="-1" type="number">
                        <label class="p-1 w-32 text-center font-semibold bg-[#400040] text-[#f1da69]" for="">پارٹی بل</label>
                        <input class="order-readonly-input w-1/4 outline-none shadow-inner border-2 bg-[#ffc0ff] border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white" id="serialNumber" readonly tabindex="-1" type="number">
                        <label class="p-1 w-32 text-center font-semibold bg-[#400040] text-[#f1da69]" for="">سیریل نمبر</label>
                    </div>
                    <div class="mt-2">
                        <input class="order-readonly-input w-full outline-none shadow-inner bg-[#ffc0c0] border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white text-center font-semibold" type="text" id="currentDateTime" value="" readonly tabindex="-1">
                    </div>
                </div>
            </div>
            <!-- bottok Section -->
            <div class="mt-2 grid grid-cols-3 gap-2 text-sm border-2 border-black p-2">

                <!-- Box 1 -->
                <div class="">
                    <div class="bg-[#804000] text-[#f1da69] px-2 py-1 -t flex justify-between">
                        <input type="radio" name="selectOption" value="op1" id="op1" class="ml-1" >
                        <span>مزدوری----سونا</span>
                        <span> </span>

                    </div>
                    <div class="mt-1 space-y-2">
                        <div class="flex items-center">
                            <label class="w-32 py-1.5 font-bold text-right text-[#f1da69] bg-[#804000]"> خالص</label>
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="number" name="op1khalasGold" id="op1khalasGold" />
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" name="op1mazdori" id="op1mazdori" type="number" />
                            <label class="w-32 py-1.5 font-bold text-left text-[#f1da69] bg-[#804000]">مزدوری</label>
                        </div>


                        <div class="flex items-center">
                            <label class="w-32 py-1.5 font-bold text-right text-[#f1da69] bg-[#804000]"> وصول کیا</label>
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="number" name="op1GoldRecieved" id="op1GoldRecieved" />
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="number" name="op1MazdooriRecieved" id="op1MazdooriRecieved" />
                            <label class="w-32 py-1.5 font-bold text-left text-[#f1da69] bg-[#804000]"> وصول کیا</label>
                        </div>

                        <div class="flex items-center">
                            <label class="w-32 py-1.5 font-bold text-right text-[#f1da69] bg-[#804000]">واپس دیا</label>
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="number" name="op1GoldPaid" id="op1GoldPaid" />
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="number" name="op1MazdooriPaid" id="op1MazdooriPaid" />
                            <label class="w-32 py-1.5 font-bold text-left text-[#f1da69] bg-[#804000]">واپس دیا</label>
                        </div>

                        <div class="flex items-center">
                            <label class="w-16 py-1.5 font-bold text-right text-[#f1da69] bg-[#804000]">بقایا</label>
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="number" name="op1RemainingGold" id="op1RemainingGold" />
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="number" name="op1RemainingCash" id="op1RemainingCash" />
                            <label class="w-16 py-1.5 font-bold text-left text-[#f1da69] bg-[#804000]"> بقایا</label>
                        </div>
                    </div>
                </div>

                <div class="border-l-2 border-dashed border-black pl-2">
                    <div class="bg-[#800000] text-[#f1da69] px-2 py-1 -t flex justify-between">
                        <input type="radio" name="selectOption" id="op2" value="op2" class="ml-1">
                        <span>سونا----سونا</span>
                        <span> </span>

                    </div>
                    <div class="mt-1 space-y-2 ">
                        <div class="flex items-center">
                            <input class="w-1/3 border  px-1 bg-[#c0c0ff]" type="number" name="op2Gold" id="op2Gold" />
                            <input class="w-1/3 border  px-1 bg-[#c0c0ff]" type="number" name="op2MazdooriInGold" id="op2MazdooriInGold" />
                            <input class="w-1/3 border  px-1 bg-[#c0c0ff]" type="number" name="op2TotalGoldwithMazdooriInGold" id="op2TotalGoldwithMazdooriInGold" />
                        </div>


                        <div class="flex items-center">
                            <input class="w-1/2 border  px-1 bg-[#c0c0ff]" type="number" name="op2cash" id="op2cash" />
                            <label class="w-32 py-1.5 font-semibold text-center text-[#f1da69] bg-[#800000]">Cash</label>
                            <label class="w-32 py-1.5 font-semibold text-center text-[#f1da69] bg-[#800000] ml-1"> وصول کیا</label>
                            <input class="w-1/2 border  px-1 bg-[#c0c0ff]" type="number" name="op2GoldRecieved" id="op2GoldRecieved" />
                        </div>

                        <div class="flex items-center">
                            <input class="w-1/2 border  px-1 bg-[#c0c0ff]" type="number" name="op2CashRecieved" id="op2CashRecieved" />
                            <label class="w-32 py-1.5 font-semibold text-center text-[#f1da69] bg-[#800000]">وصول کیا</label>
                            <label class="w-32 py-1.5 font-semibold text-center text-[#f1da69] bg-[#800000] ml-1">واپس دیا</label>
                            <input class="w-1/2 border  px-1 bg-[#c0c0ff]" type="number" name="op2GoldPaid" id="op2GoldPaid" />
                        </div>

                        <div class="flex items-center">
                            <input class="w-1/2 border  px-1 bg-[#c0c0ff]" type="number" name="op2RemainingCash" id="op2RemainingCash" />
                            <label class="w-16 py-1.5 font-semibold text-center text-[#f1da69] bg-[#800000]"> بقایا</label>
                            <label class="w-16 py-1.5 font-semibold text-center text-[#f1da69] bg-[#800000] ml-1"> بقایا</label>
                            <input class="w-1/2 border  px-1 bg-[#c0c0ff]" type="number" name="op2RemainingGold" id="op2RemainingGold" />
                        </div>
                    </div>
                </div>

                <!-- Box 3 -->
                <div class="border-l-2 border-dashed border-black pl-2">
                    <div class="bg-[#400040] text-[#f1da69] px-2 py-1 flex justify-between">
                        <input type="radio" name="selectOption" value="op3" id="op3" class="ml-1">
                        <span>کیش----کیش</span>
                        <span> </span>

                    </div>
                    <div class="mt-1 space-y-2">
                        <div class="flex items-center">
                            <input class="w-1/3 border  text-right px-1 bg-[#ffc0c0]" type="number" name="op3cash" id="op3cash" />
                            <input class="w-1/3 border  text-right px-1 bg-[#ffc0c0]" type="number" name="op3mazdooriInCash" id="op3mazdooriInCash" />
                            <input class="w-1/3 border  text-right px-1 bg-[#ffc0c0]" type="number" name="op3totalCashwithMazdooriInCash" id="op3totalCashwithMazdooriInCash" />
                        </div>


                        <div class="flex items-center justify-end">
                            <label class="w-20 py-1.5 font-bold text-center bg-[#400040] text-[#f1da69]"> وصول کیا</label>
                            <input class="w-1/2 border  px-1 bg-[#ffc0c0]" type="number" name="op3CashRecieved" id="op3CashRecieved" />
                        </div>

                        <div class="flex items-center justify-end">
                            <label class="w-20 py-1.5 font-bold text-center bg-[#400040] text-[#f1da69]">واپس دیا</label>
                            <input class="w-1/2 border  px-1 bg-[#ffc0c0]" type="number" name="op3CashPaid" id="op3CashPaid" />
                        </div>

                        <div class="flex items-center justify-end">
                            <label class="w-20 py-1.5 font-bold text-center bg-[#400040] text-[#f1da69]"> بقایا</label>
                            <input class="w-1/2 border  px-1 bg-[#ffc0c0]" type="number" name="op3RemainingCash" id="op3RemainingCash" />
                        </div>
                    </div>
                </div>

            </div>
            <div class="w-full flex gap-5 mt-2">
                <!-- Branding & Time -->
                <div
                    class="w-[40%] flex justify-between items-center bg-green-400 p-2 text-white text-xl font-serif italic">
                    <div>{{ $systemSettings->software_name }}</div>

                </div>

                <!-- Bottom Buttons -->
                <div class="w-3/5">
                    <div class="flex items-center justify-between">
                        <span id="currentTime" class="w-1/3 text-black font-mono text-xl font-bold"></span>
                        <select id="orderSelect" onchange="fetchOldParchies(this.value)" class="w-4/6 bg-white text-black border border-gray-300">
                          </select>
                    </div>
                    <div>
                        <button id="JustPrint" class="bg-amber-100 text-black py-1 w-20 cursor-pointer justPrint" onclick="justprint()">JustPrint</button>
                        <button type="button" onclick="saveOrder()" id="saveOrder" class="bg-stone-500 py-1 w-20 cursor-pointer">Save</button>
                        <button id="Print" class="bg-pink-200 text-black py-1 w-20 cursor-pointer" onclick="print()">Print</button>
                        <button id="clearButton" class="bg-red-600 py-1 w-20 cursor-pointer">Clear</button>
                        <a href = "{{route('party.create.form')}}" ><button class="bg-green-100 text-black py-1 w-20 cursor-pointer cursor-pointer">Parties</button></a>
                        <a href="{{url('advance')}}" class="bg-orange-400 text-black py-1 w-20">Advance</a>
                        <button class="bg-pink-400 text-black py-1 w-20 cursor-pointer">Exit</button>
                    </div>
                </div>
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
        /* Prevent editing and focus on readonly display inputs (JS can still set .val()) */
        .order-readonly-input {
            pointer-events: none;
            cursor: default;
            -webkit-user-select: none;
            user-select: none;
        }

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
            table tr {
                color: #000000 !important;
            }

            /* Force button text to black in dark mode */
            /* This ensures white/cream text becomes black in dark mode */
            button:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]) {
                color: #000000 !important;
            }

            /* Override white and cream colors on buttons in dark mode */
            button[class*="text-white"],
            button[class*="text-cream"],
            button[style*="color: white"],
            button[style*="color: #fff"],
            button[style*="color: #ffffff"],
            button[style*="color: #fefefe"],
            button[style*="color: #f5f5f5"] {
                color: #000000 !important;
            }

            /* Force label, p, a, and span text to black in dark mode */
            label:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            p:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            a:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            span:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]) {
                color: #000000 !important;
            }

            /* Override white and cream colors for labels, p, a, and span in dark mode */
            label[class*="text-white"],
            p[class*="text-white"],
            a[class*="text-white"],
            span[class*="text-white"],
            label[class*="text-cream"],
            p[class*="text-cream"],
            a[class*="text-cream"],
            span[class*="text-cream"],
            label[style*="color: white"],
            label[style*="color: #fff"],
            label[style*="color: #ffffff"],
            label[style*="color: #fefefe"],
            label[style*="color: #f5f5f5"],
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

     function justprint() {

        let serialNumber = (parseInt($('#serialNumber').val()) || 0) + 1;
        let formattedSerial = String(serialNumber).padStart(6, '0'); // → "000100"
        let lastPartyBills = (parseInt($('#lastPartyBills').val()) || 0) + 1;

        let payment_option_selet = $('input[name="selectOption"]:checked').val() || '';

        let GoldRecieved = 0;
        let RemainingGold = 0;

        // Payment options logic
        if (payment_option_selet === "op1") {
            GoldRecieved = $('#op1GoldRecieved').val() || 0;
            RemainingGold = $('#op1RemainingGold').val() || 0;
        } 
        else if (payment_option_selet === "op2") {
            GoldRecieved = $('#op2GoldRecieved').val() || 0;
            RemainingGold = $('#op2RemainingGold').val() || 0;
        } 
        else if (payment_option_selet === "op3") {
            GoldRecieved = 0;
            RemainingGold = 0;
        }

        let payload = {
            serialNumber :formattedSerial,
            lastPartyBills :lastPartyBills,
            party_id: $('#party_id').val() || 0,
            partyName: $('#partyName').val() || 'N/A',
            currentDateTime: $('#currentDateTime').val() || 'N/A',
            weightCastig: $('#weightCastig').val() || 0,
            mailCode: $('#mailCode').val() || 0,
            mazdoriRate: $('#mazdoriRate').val() || 0,
            netWeight: $('#netWeight').val() || 0,
            wasteRate: $('#wasteRate').val() || 0,
            tollaRate: $('#tollaRate').val() || 0,
            gramRate: $('#gramRate').val() || 0,
            wasteCasted: $('#wasteCasted').val() || 0,
            wasteDiscountRate: $('#wasteDiscountRate').val() || 0,
            mazdoorie: $('#mazdoorie').val() || 0,
            InOutCheck: $('#InOutCheck').is(':checked') ? 1 : 0,
            InOut: $('#InOut').val() || 0,
            remarks: $('#remarks').val() || '',
            selectOption: $('input[name="selectOption"]:checked').val() || '',
            totalGold: $('#totalGold').val() || 0,
            totalMazdoori: $('#totalMazdoori').val() || 0,
            totalMazdooriInGold: $('#totalMazdooriInGold').val() || 0,
            totalMazdooriInCash: $('#totalMazdooriInCash').val() || 0,
            totalWeight: $('#totalWeight').val() || 0,
            totalWeightCasted: $('#totalWeightCasted').val() || 0,
            khalis: $('#khalis').val() || 0,
            advance: $('#advance').val() || 0,
            totalKhalis: $('#totalKhalis').val() || 0,
            remainingMazdoori: $('#remainingMazdoori').val() || 0,
            wapsiGold: $('#wapsiGold').val() || 0,
            castingWeight: $('#castingWeight').val() || 0,
            GoldRecieved: GoldRecieved,
            RemainingGold: RemainingGold,
            _token: "{{ csrf_token() }}" // ✅ CSRF token added here
        };


        



        $.ajax({
            url: "{{ route('print.data') }}",
            type: "POST",
            data: payload, // ✅ send as form data (Laravel will read it fine)
            success: function (response) {
                var printWindow = window.open('', '', 'height=600,width=800');
                printWindow.document.write(response);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
            },
            error: function (xhr) {
                alert("Something went wrong!");
            }
        });
    }

//     $(document).on('click', '.justPrint', function () {
        
//     $.ajax({
//         url: "{{ route('print.data') }}",  // Laravel route
//         type: "POST",
//         data: {
//             _token: "{{ csrf_token() }}", // CSRF token
//             id: 123,  // example data, replace with your dynamic data
//             name: "Sample User"
//         },
//         success: function (response) {
//             // Open a new window and write the returned HTML
//             var printWindow = window.open('', '', 'height=600,width=800');
//             printWindow.document.write(response);
//             printWindow.document.close();
//             printWindow.focus();
//             printWindow.print();
//         },
//         error: function (xhr) {
//             alert("Something went wrong!");
//         }
//     });
// });





    function getOldParchies() {
        var partyId = $('#getPartyData').val().trim();

        if (partyId === '') {
            toastr.error('Please enter Party ID.', 'Error');
            return;
        }

        showLoader();
        $.ajax({
            url: '/api/party/old-parchi/' + partyId,  // Correct URL
            type: 'GET',
            dataType: 'json',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer {{ session('auth_token') }}"); // Blade works only in blade template
            },
            success: function (response) {
                let select = $('#orderSelect');
                select.empty();
                select.append('<option value="">Select Order</option>');

                response.forEach(function(order) {

                    let formattedOrderId = String(order.id).padStart(6, '0');
                    select.append('<option value="'+ order.id +'">'+ formattedOrderId +': '+ order.created_at +'</option>');
                });

                hideLoader();
            },
            error: function (xhr) {
                if (xhr.status === 401) {

                   toastr.error(xhr.responseJSON, 'Error');
                } else {
                    toastr.error('Something went wrong.', 'Error');
                }
                hideLoader();
            }
        });
    }

    function fetchOldParchies(id) {
        showLoader();
        $.ajax({
            url: "/api/party/orderRecord/" + id,  // API route
            type: "GET",
            dataType: "json",
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer {{ session('auth_token') }}");
            },
            success: function (response) {
                let data = response; // Your JSON object from API

                // Basic fields
                $('#party_id').val(data.party_id);
                $('#weightCastig').val(data.castingWeight);
                $('#mailCode').val(data.mailCode);
                $('#remarks').val(data.remarks);
                $('#wapsiGold').val(data.wapsiGold);
                $('#netWeight').val(data.weightReady);
                $('#wasteCasted').val(data.wasteCasted);
                $('#totalWeight').val(data.totalWeight);
                $('#totalWeightCasted').val(data.totalWeightCasted);
                $('#khalis').val(data.khalis);
                $('#advance').val(data.advance);
                $('#totalKhalis').val(data.totalKhalis);
                $('#InOut').val(data.InOut);
                $('#mazdoorie').val(data.mazdoorie);
                $('#remainingMazdoori').val(data.remainingMazdoori);
                $('#totalMazdoori').val(data.totalMazdoori);
                $('#mazdoriRate').val(data.mazdoriRate);
                $('#wasteRate').val(data.wasteRate);
                $('#tollaRate').val(data.tollaRate);

                // ✅ Radio button selection based on selectOption
                $('input[name="selectOption"][value="' + data.selectOption + '"]').prop('checked', true);

                // ✅ Option 1 fields
                $('#op1khalasGold').val(data.totalKhalis);
                $('#op1mazdori').val(data.totalMazdoori);
                $('#op1GoldRecieved').val(data.op1GoldRecieved);
                $('#op1MazdooriRecieved').val(data.op1MazdooriRecieved);
                $('#op1GoldPaid').val(data.op1GoldPaid);
                $('#op1MazdooriPaid').val(data.op1MazdooriPaid);
                $('#op1RemainingGold').val(data.op1RemainingGold);
                $('#op1RemainingCash').val(data.op1RemainingCash);

                // ✅ Option 2 fields
                $('#op2Gold').val(data.totalKhalis);
                $('#op2MazdooriInGold').val(data.totalMazdooriInGold);
                let op2TotalGoldwithMazdooriInGoldtotal = (
                    parseFloat(data.totalKhalis) + parseFloat(data.totalMazdooriInGold)
                ).toFixed(3);

                $('#op2TotalGoldwithMazdooriInGold').val(op2TotalGoldwithMazdooriInGoldtotal);

                $('#op2cash').val((data.op2RemainingGold * 8573.388  ).toFixed(3));

                $('#op2CashRecieved').val(data.op2CashRecieved);
                $('#op2GoldRecieved').val(data.op2GoldRecieved);
                $('#op2GoldPaid').val(data.op2GoldPaid);
                $('#op2RemainingCash').val(data.op2RemainingCash);
                $('#op2RemainingGold').val(data.op2RemainingGold);

                // ✅ Option 3 fields
                $('#op3cash').val(Math.ceil(data.totalKhalis * 8573.388).toFixed(3));
                $('#op3mazdooriInCash').val(Math.ceil(data.totalMazdoori).toFixed(3));
                
                $('#op3CashRecieved').val(data.op3CashRecieved);
                $('#op3CashPaid').val(data.op3CashPaid);
                let totalop3totalCashwithMazdooriInCash = (Math.ceil(data.totalKhalis * 8573.388) + Math.ceil(data.totalMazdoori)).toFixed(3);
             $('#op3totalCashwithMazdooriInCash').val(totalop3totalCashwithMazdooriInCash);
             $('#op3RemainingCash').val(data.op3RemainingCash);


                // ✅ Checkbox for InOutCheck
                $('#InOutCheck').prop('checked', data.InOutCheck == 1);

                disableButtons();
                hideLoader();
            },
            error: function(xhr) {
                console.log("Error:", xhr.responseText);
                hideLoader();
            }
        });
    }

    function saveOrder() {
        // Collect values from input fields
        let payload = {
    party_id: $('#party_id').val() || 0,
    created_by: 1,
    weightCastig: $('#weightCastig').val() || 0,
    mailCode: $('#mailCode').val() || 0,
    mazdoriRate: $('#mazdoriRate').val() || 0,
    netWeight: $('#netWeight').val() || 0,
    wasteRate: $('#wasteRate').val() || 0,
    tollaRate: $('#tollaRate').val() || 0,
    goldIN: $('#goldIN').val() || 0,
    goldOut: $('#goldOut').val() || 0,
    cashIn: $('#cashIn').val() || 0,
    cashOut: $('#cashOut').val() || 0,
    wasteCasted: $('#wasteCasted').val() || 0,
    mazdoorie: $('#mazdoorie').val() || 0,
    InOutCheck: $('#InOutCheck').is(':checked') ? 1 : 0,
    InOut: $('#InOut').val() || 0,
    remarks: $('#remarks').val() || '',
    selectOption: $('input[name="selectOption"]:checked').val() || '',

    totalGold: $('#totalGold').val() || 0,
    totalMazdoori: $('#totalMazdoori').val() || 0,
    totalMazdooriInGold: $('#totalMazdooriInGold').val() || 0,
    totalMazdooriInCash: $('#totalMazdooriInCash').val() || 0,
    goldInAfter: $('#goldInAfter').val() || 0,
    goldOutAfter: $('#goldOutAfter').val() || 0,
    cashInAfter: $('#cashInAfter').val() || 0,
    cashOutAfter: $('#cashOutAfter').val() || 0,

    // Option 1
    op1khalasGold: $('#op1khalasGold').val() || 0,
    op1mazdori: $('#op1mazdori').val() || 0,
    op1GoldRecieved: $('#op1GoldRecieved').val() || 0,
    op1MazdooriRecieved: $('#op1MazdooriRecieved').val() || 0,
    op1GoldPaid: $('#op1GoldPaid').val() || 0,
    op1MazdooriPaid: $('#op1MazdooriPaid').val() || 0,
    op1RemainingGold: $('#op1RemainingGold').val() || 0,
    op1RemainingCash: $('#op1RemainingCash').val() || 0,

    // Option 2
    op2TotalGoldwithMazdooriInGold: $('#op2TotalGoldwithMazdooriInGold').val() || 0,
    op2MazdooriInGold: $('#op2MazdooriInGold').val() || 0,
    op2Gold: $('#op2Gold').val() || 0,
    op2cash: $('#op2cash').val() || 0,
    op2GoldRecieved: $('#op2GoldRecieved').val() || 0,
    op2GoldPaid: $('#op2GoldPaid').val() || 0,
    op2RemainingGold: $('#op2RemainingGold').val() || 0,
    op2CashRecieved: $('#op2CashRecieved').val() || 0,

    op2RemainingCash: $('#op2RemainingCash').val() || 0,

    // Option 3
    op3cash: $('#op3cash').val() || 0,
    op3mazdooriInCash: $('#op3mazdooriInCash').val() || 0,
    op3totalCashwithMazdooriInCash: $('#op3totalCashwithMazdooriInCash').val() || 0,
    op3CashRecieved: $('#op3CashRecieved').val() || 0,
    op3CashPaid: $('#op3CashPaid').val() || 0,
    op3RemainingCash: $('#op3RemainingCash').val() || 0,

    totalWeight: $('#totalWeight').val() || 0,
    totalWeightCasted: $('#totalWeightCasted').val() || 0,
    khalis: $('#khalis').val() || 0,
    advance: $('#advance').val() || 0,
    totalKhalis: $('#totalKhalis').val() || 0,
    remainingMazdoori: $('#remainingMazdoori').val() || 0,
    wapsiGold: $('#wapsiGold').val() || 0,
    castingWeight: $('#castingWeight').val() || 0
};

    let selectOption = $('input[name="selectOption"]:checked').val();

    if (!selectOption) {  
        toastr.error('Must Select Payment Option', 'Error');
        return;
    }

    // Prevent double submit: disable button and ignore further clicks
    var $saveBtn = $('#saveOrder');
    if ($saveBtn.prop('disabled')) {
        return;
    }
    $saveBtn.prop('disabled', true).addClass('opacity-50 cursor-not-allowed');

        console.log(payload); // Debu
        $.ajax({
            url: '/api/order',  // API endpoint
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(payload),
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer {{ session('auth_token') }}");
            },
            success: function(response) {
                if (response.status === 'success') {
                     toastr.success('Order saved successfully!', 'Success');
                     $('#clearButton').trigger('click');
                } else {
                     toastr.success('Order saved successfully!', 'Success');
                     $('#clearButton').trigger('click');
                }

                $('#serialNumber').val(response.order);
                $('#party_id').val(party_id);
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                } else {
                     toastr.error(xhr.responseText, 'Error');
                }
            },
            complete: function() {
                $saveBtn.prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
            }
        });
}




function updateCurrentTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var seconds = String(now.getSeconds()).padStart(2, '0');
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12;
        var timeStr = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
        var el = document.getElementById('currentTime');
        if (el) el.textContent = timeStr;
    }

$(document).ready(function() {
        updateCurrentTime();
        setInterval(updateCurrentTime, 1000);
        $('#getPartyData').focus();
        var tollaRate = $('#tollaRate').val();
        let RatePerGram = tollaRate / 11.664; 
        $('#gramRate').val(RatePerGram.toFixed(3));

        getLastOrderInformation();


        function getLastOrderInformation(){

            $.ajax({
                url: '/api/getLastOrderInformation',
                type: 'GET',
                dataType: 'json',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer {{ session('auth_token') }}"); // Replace with actual token if needed
                },
                success: function(response) {

                    if (response.status === 'success') {
                        let formattedOrderId = String(response.last_order_id).padStart(6, '0');
                        console.log("Last Order ID: " + formattedOrderId);
                        $('#lastPartyBills').val(response.total_orders_for_party);
                        $('#lastPartyBillNo').val(response.party_id);
                        $('#serialNumber').val(formattedOrderId);
                    }

                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.message, 'Error');
                }
            });
        }

    function updateDateTime() {
            var now = new Date();
            var day = String(now.getDate()).padStart(2, '0'); // Day with leading zero
            var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var month = months[now.getMonth()]; // Month name
            var year = now.getFullYear(); // Full year
            var hours = String(now.getHours()).padStart(2, '0'); // Hours with leading zero
            var minutes = String(now.getMinutes()).padStart(2, '0'); // Minutes with leading zero
            var seconds = String(now.getSeconds()).padStart(2, '0'); // Seconds with leading zero
            
            // var dateTime = day + '/' + month + '/' + year + ' ' + hours + ':' + minutes + ':' + seconds; // Format: 07/May/2025 14:30:45
            var dateTime = day + '/' + month + '/' + year ;
            $('#currentDateTime').val(dateTime);
        }

        updateDateTime(); // Show immediately
       
        setInterval(updateDateTime, 1000); // Update every second




  
    $('#getPartyData').keypress(function(e) {
        if (e.which == 13) { // Enter key
            e.preventDefault();

            var partyID = $(this).val();
            if (partyID == '') {
                toastr.error('Please enter a Party ID', 'Error');

                return;
            }
            showLoader();

            $.ajax({
                url: '/api/parties/' + partyID, // Your API route
                type: 'GET',
                dataType: 'json',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer {{ session('auth_token') }}"); // Replace with actual token if needed
                },
                success: function(response) {

                    

                    if (response.response_code === 201) {
                        toastr.error(response.message, 'Error');
                    } else if (response.response_code === 200) {

                        $('#lastPartyBills').val(response.data.totalOrders);
                        if (response.data.party_type === "cash") {
                            $('#partyName').val("cash party");
                             $('#advance').val(parseFloat(response.data['gold_summary'].balance).toFixed(3));
                            $('#remainingMazdoori').val(response.data['cash_summary'].balance);
                            $('#party_id').val(partyID);
                            $('#remarks').val(response.data.lastRemarks);
                        }else{
                        $('#partyName').val(response.data['party_regular'].businessName);
                        $('#mazdoriRate').val(response.data['party_regular'].wasteDiscount);
                        $('#wasteRate').val(response.data['party_regular'].wasteDiscount);
                        $('#advance').val(parseFloat(response.data['gold_summary'].balance).toFixed(3));
                        $('#remainingMazdoori').val(Math.floor(response.data['cash_summary'].balance));

                        $('#party_id').val(partyID);
                        $('#remarks').val(response.data.lastRemarks);

                        }
               
                        
                    }

                    $('#remarks').focus();
                    hideLoader();
                    
                },
                error: function(xhr) {
                    toastr.error(xhr.responseText, 'Error');
                    hideLoader();
                }
            });
        }
    });

    $('#remarks').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
           let remarks =  $('#remarks').val();
           if(remarks ===''){
            toastr.error('Please enter remarks!', 'Error');
            $('#remarks').focus();
           }else{
            e.preventDefault(); // Prevent default tab behavior
            $('#mailCode').focus();

           }
            
        }
    });

    $('#mailCode').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter or Tab
            e.preventDefault(); // Prevent default navigation

            let value = $('#mailCode').val().trim();

            if (value === '') {
                toastr.error('Please enter Mail Code!', 'Error');
                $('#mailCode').focus(); // Stay on the same field
            } else {
                $('#InOutCheck').focus(); // Move to next input
            }
        }
    });


    $('#InOutCheck').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#pieceCheck').focus();
        }
    });

    $('#pieceCheck').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#mazdoriRate').focus();
        }
    });
    $('#mazdoriRate').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#wasteRate').focus();
        }
    });
    
    $('#tollaRate').on('keydown', function(e) {
        if (e.which === 13) { // Enter key
            e.preventDefault();
            
            let tollaRate = parseFloat($('#tollaRate').val()) || 0;
            
            if (tollaRate === 0 || tollaRate === '') {
                toastr.error('Please enter a valid Tolla Rate!', 'Error');
                $('#tollaRate').focus();
                return;
            }
            
            // Calculate gram rate using formula: tollaRate / 11.664
            let gramRate = tollaRate / 11.664;
            let gramRateFormatted = gramRate.toFixed(3);
            
            // Update gramRate field
            $('#gramRate').val(gramRateFormatted);
            
            // Make AJAX call to save rates
            $.ajax({
                url: '/api/system-settings/update-rates',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    gold_rate: tollaRate,
                    gram_rate: parseFloat(gramRateFormatted)
                }),
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer {{ session('auth_token') }}");
                    xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
                },
                success: function(response) {
                    toastr.success('Gold rate and gram rate updated successfully!', 'Success');
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        toastr.error('Unauthorized. Please login again.', 'Error');
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        toastr.error(xhr.responseJSON.message, 'Error');
                    } else {
                        toastr.error('Failed to update rates. Please try again.', 'Error');
                    }
                }
            });
        }
    });
    
    $('#wasteRate').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter or Tab
            e.preventDefault(); // Prevent default navigation

            let value = $('#wasteRate').val().trim();

            if (value === '') {
                toastr.error('Please enter Waste Rate!', 'Error');

                $('#wasteRate').focus(); // Stay on same field
            } else {
                $('#weightCastig').focus(); // Move to next input
            }
        }
    });

    $('#weightCastig').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter or Tab
            e.preventDefault(); // Prevent default navigation

            let value = $('#weightCastig').val().trim();

            if (value === '') {
                toastr.error('Please enter weight first!', 'Error');
                $('#weightCastig').focus(); // Stay on the same input
            } else {
                $('#wapsiGold').focus(); // Move to next input
            }
        }
    });

    $('#wapsiGold').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            let mailCode = parseFloat($('#mailCode').val()) || 0;
            // replace #someInput with your actual input ID
            let wasteRate = 0;

            if (mailCode >= 0 && mailCode <= 15) {
                wasteRate = 0.100;
            } else if (mailCode >= 16 && mailCode <= 19) {
                wasteRate = 0.150;
            } else if (mailCode >= 20 && mailCode <= 29) {
                wasteRate = 0.250;
            } else if (mailCode >= 30 && mailCode <= 34) {
                wasteRate = 0.300;
            } else if (mailCode >= 35 && mailCode <= 39) {
                wasteRate = 0.350;
            } else if (mailCode >= 40 ) {
                wasteRate = 0.400;
            }


            $('#wasteRate').val(wasteRate);


            let weightCastig = parseFloat($('#weightCastig').val()) || 0;
            
            let wapsiGold = parseFloat($('#wapsiGold').val()) || 0;
             wasteRate = parseFloat($('#wasteRate').val()) || 0;
            let gramRate = parseFloat($('#gramRate').val()) || 0;
            let netWeight = weightCastig - wapsiGold;
            let waste = ( netWeight *  wasteRate) / 10;
            let totalWeight = netWeight + waste;
            let advance = parseFloat($('#advance').val()) || 0;

            var mazdoriRate = $('#mazdoridiscountRate').val();

            var mazdoridiscountRate = $('#mazdoriRate').val();
            var discount = (mazdoriRate * mazdoridiscountRate) / 100;
            discount = Math.round(discount)

            var totaldiscount = mazdoriRate - discount;

            $('#mazdoriRate').val(totaldiscount);

            let mazdoorieTotal = totaldiscount * netWeight;
            $('#mazdoorie').val(mazdoorieTotal);





            let mazdoorie = parseFloat($('#mazdoorie').val()) || 0;
            let remainingMazdoori = parseFloat($('#remainingMazdoori').val()) || 0;
            let totalMazdoori = mazdoorie + remainingMazdoori;
            let op2MazdooriInGold = totalMazdoori / gramRate;


            if ($('#InOutCheck').is(':checked')) {
                
                let ander = ( 96 - mailCode) / 96;

                
                $('#anderCheckValue').val(ander.toFixed(3));
                var khalis = ( totalWeight * ander );
                let resultroundedvalue = (Math.ceil(khalis * 100) / 100).toFixed(3);
                $('#khalis').val(resultroundedvalue);
                let mailNikla  = totalWeight - khalis;
                let mailNiklaroundedvalue = (Math.floor(mailNikla * 100) / 100).toFixed(3);

                $('#totalWeightCasted').val(mailNiklaroundedvalue);



            } else {
                

                var maildata = mailCode + 96 ; 
                var khalis = (totalWeight * 96) / maildata;
                let resultroundedvalue = (Math.ceil(khalis * 100) / 100).toFixed(3);
                $('#khalis').val(resultroundedvalue);
                let ander = khalis / totalWeight ;
                $('#anderCheckValue').val(ander.toFixed(3));
                let mailNikla  = totalWeight - khalis;
                let mailNiklaroundedvalue = (Math.floor(mailNikla * 100) / 100).toFixed(3);

                $('#totalWeightCasted').val(mailNiklaroundedvalue);

            }





            let totalKhalis = khalis + advance;



            $('#totalKhalis').val((Math.ceil(totalKhalis * 100) / 100).toFixed(3));
            $('#netWeight').val(netWeight.toFixed(3));
            $('#wasteCasted').val(waste.toFixed(3));
            $('#totalWeight').val(totalWeight.toFixed(3));
            $('#totalMazdoori').val(totalMazdoori);

            var totalwaitforcountkhails = $('#totalWeight').val();
            var mailniklaforcountkhails = $('#totalWeightCasted').val();

            $('#khalis').val((totalwaitforcountkhails - mailniklaforcountkhails).toFixed(3));


            $('#op2Gold').val((Math.ceil(totalKhalis * 100) / 100).toFixed(3));
            $('#op2MazdooriInGold').val((Math.ceil(op2MazdooriInGold * 100) / 100).toFixed(3));

            let wasteCastedValue =parseFloat($('#wasteCasted').val()) || 0;
            let inOutValue = ( wasteCastedValue * 96 ) / (mailCode + 96);
            $('#InOut').val((Math.floor(inOutValue * 100) / 100).toFixed(3));

            let op2Goldvalue = parseFloat($('#op2Gold').val()) || 0;
            let op2MazdooriInGoldvalue = parseFloat($('#op2MazdooriInGold').val()) || 0;
            let op2TotalGoldwithMazdooriInGold = op2Goldvalue + op2MazdooriInGoldvalue ;
            $('#op2TotalGoldwithMazdooriInGold').val((Math.ceil(op2TotalGoldwithMazdooriInGold * 100) / 100).toFixed(3));
            $('#op1khalasGold').val((Math.ceil(totalKhalis * 100) / 100).toFixed(3));
            $('#op1mazdori').val(totalMazdoori.toFixed(3));


            let op3cash = (Math.ceil(totalKhalis * 100) / 100).toFixed(3) * gramRate ;

            $('#op3mazdooriInCash').val(totalMazdoori.toFixed(3));

            $('#op3cash').val(op3cash.toFixed(3));

            let op3mazdooriInCashvalue =parseFloat($('#op3mazdooriInCash').val()) || 0;
            let op3cashvalue = parseFloat($('#op3cash').val()) || 0;
            let op3totalCashwithMazdooriInCash = op3mazdooriInCashvalue + op3cashvalue;
            $('#op3totalCashwithMazdooriInCash').val(op3totalCashwithMazdooriInCash.toFixed(3));





            $('#netWeight').focus();
            
        }
    });

    $('#netWeight').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior

            $('input[name="selectOption"][value="op2"]').prop('checked', true);
            let mazdoriRate = $('#mazdoriRate').val();
            let netWeight = $('#netWeight').val();
            
            $('#op2').focus();



            
        }
    });

    $('#op2').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { 
            e.preventDefault(); 
            let op2TotalGoldwithMazdooriInGold = parseFloat($('#op2TotalGoldwithMazdooriInGold').val()) || 0;
            if (op2TotalGoldwithMazdooriInGold >= 0) {
                $('#op2GoldRecieved').focus();
            } else {
                $('#op2GoldPaid').focus();
            }
        }
    });

    $('#op2GoldRecieved').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) {
            let op2TotalGoldwithMazdooriInGold =parseFloat( $('#op2TotalGoldwithMazdooriInGold').val()) || 0;
            let op2GoldRecieved =parseFloat( $('#op2GoldRecieved').val()) || 0;
            $('#op2RemainingGold').val(op2TotalGoldwithMazdooriInGold - op2GoldRecieved);
            $('#op2GoldPaid').focus();
        }
    });   

    $('#op2GoldPaid').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) {
            // Get values and convert them to numbers
            let op2TotalGoldwithMazdooriInGold =parseFloat( $('#op2TotalGoldwithMazdooriInGold').val()) || 0;
            let op2GoldRecieved =parseFloat( $('#op2GoldRecieved').val()) || 0;
            let op2GoldPaid = parseFloat($('#op2GoldPaid').val()) || 0;

            // Perform calculation
            let op2RemainingGold = (op2TotalGoldwithMazdooriInGold + op2GoldPaid) - op2GoldRecieved;
            $('#op2RemainingGold').val(op2RemainingGold);

            let gramRate =  $('#gramRate').val();
            let goldValueInCash = op2RemainingGold * gramRate ;
            $('#op2cash').val(Math.ceil(goldValueInCash * 1000) / 1000);
            $('#op2CashRecieved').focus();
        }
    });

    $('#op2CashRecieved').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) {
            e.preventDefault(); // Prevent default behavior
            // Get values and convert them to numbers
            let op2cash = parseFloat($('#op2cash').val()) || 0;
            let op2CashRecieved = parseFloat($('#op2CashRecieved').val()) || 0;
            // Perform calculation
            let op2remainingCash = (op2cash - op2CashRecieved);
            $('#op2RemainingCash').val((Math.ceil(op2remainingCash * 100) / 100).toFixed(2));
            $('#saveOrder').focus();
        }
    });





    $('#op1').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { 
            e.preventDefault();
            let op1khalasGold = parseFloat($('#op1khalasGold').val()) || 0;
            if (op1khalasGold >= 0) {
                $('#op1GoldRecieved').focus();
            } else {
                $('#op1MazdooriPaid').focus();
            }
        }
    });

    $('#op3').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { 
            e.preventDefault();
            let op3totalCashwithMazdooriInCash = parseFloat($('#op3totalCashwithMazdooriInCash').val()) || 0;
            if (op3totalCashwithMazdooriInCash >= 0) {
                $('#op3CashRecieved').focus();
            } else {
                $('#op3CashPaid').focus();
            }
        }
    });
    $('#op1GoldRecieved').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) {
            let op1khalasGold = $('#op1khalasGold').val();
            let op1GoldRecieved = $('#op1GoldRecieved').val();
            $('#op1RemainingGold').val(op1khalasGold - op1GoldRecieved);
            $('#op1GoldPaid').focus();
        }
    });    

    $('#op1GoldPaid').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) {
            // Get values and convert them to numbers
            let op1khalasGold = parseFloat($('#op1khalasGold').val()) || 0;
            let op1GoldPaid = parseFloat($('#op1GoldPaid').val()) || 0;
            let op1GoldRecieved = parseFloat($('#op1GoldRecieved').val()) || 0;

            // Perform calculation
            let remainingGold = (op1khalasGold + op1GoldPaid) - op1GoldRecieved;
            $('#op1RemainingGold').val(remainingGold);

            $('#op1MazdooriRecieved').focus();
        }
    });

    $('#op1MazdooriRecieved').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) {
            let op1mazdori = $('#op1mazdori').val();
            let op1MazdooriRecieved = $('#op1MazdooriRecieved').val();
            $('#op1RemainingCash').val(op1mazdori - op1MazdooriRecieved);
            $('#op1MazdooriPaid').focus();
        }
    });

    $('#op1MazdooriPaid').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) {
            let op1mazdori = parseFloat($('#op1mazdori').val()) || 0;
            let op1MazdooriPaid = parseFloat($('#op1MazdooriPaid').val()) || 0;
            let op1MazdooriRecieved = parseFloat($('#op1MazdooriRecieved').val()) || 0;

            // Perform calculation
            let remainingMazdoori= (op1mazdori + op1MazdooriPaid) - op1MazdooriRecieved;
            $('#op1RemainingCash').val(remainingMazdoori);
        }
    });

    $('#op3CashRecieved').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) {
            let op3totalCashwithMazdooriInCash = parseFloat($('#op3totalCashwithMazdooriInCash').val()) || 0;
            let op3CashRecieved = parseFloat($('#op3CashRecieved').val()) || 0;
            $('#op3RemainingCash').val(op3totalCashwithMazdooriInCash - op3CashRecieved);
            $('#op3CashPaid').focus();
        }
    }); 

    $('#op3CashPaid').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) {
            let op3totalCashwithMazdooriInCash = parseFloat($('#op3totalCashwithMazdooriInCash').val()) || 0;
            let op3CashRecieved = parseFloat($('#op3CashRecieved').val()) || 0;
            let op3CashPaid = parseFloat($('#op3CashPaid').val()) || 0;

            // Perform calculation
            let op3remainingMazdoori= (op3totalCashwithMazdooriInCash + op3CashPaid) - op3CashRecieved;
            $('#op3CashPaid').val(op3remainingMazdoori);
        }
    });

    $('#totalWeight').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#totalWeightCasted').focus();
        }
    });

    $('#totalWeightCasted').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#khalis').focus();
        }
    });

    $('#khalis').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#advance').focus();
        }
    });

    $('#advance').on('keydown', function(e) {
        if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
            e.preventDefault(); // Prevent default tab behavior
            $('#totalKhalis').focus();
        }
    });


        $('#op2RemainingCash').on('keydown', function(e) {
            if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
                e.preventDefault(); // Prevent default tab behavior
                $('#saveOrder').focus();
            }
        });

        $('#op1RemainingGold').on('keydown', function(e) {
            if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
                e.preventDefault(); // Prevent default tab behavior
                $('#saveOrder').focus();
            }
        });

        $('#op3RemainingCash').on('keydown', function(e) {
            if (e.which === 13 || e.which === 9) { // Enter (13) or Tab (9)
                e.preventDefault(); // Prevent default tab behavior
                $('#saveOrder').focus();
            }
        });

    $('#clearButton').on('click', function(e) {
        e.preventDefault();
        $('input[type="text"], input[type="number"], input[type="email"], input[type="password"]').not('#lastPartyBills, #lastPartyBillNo, #serialNumber, #mazdoridiscountRate,#wasteDiscountRate,#tollaRate,#gramRate').val('');
        $('textarea').val('');
        $('input[type="checkbox"], input[type="radio"]').prop('checked', false);
        $('select').prop('selectedIndex', 0);

        enableButtons();
    });



});

function print() {
    let Party = $("#getPartyData").val();
    let remarks = $("#remarks").val();
    let mailCode = $("#mailCode").val();
    let weightCastig = $("#weightCastig").val();

    if (Party && remarks && mailCode && weightCastig) {
        // ✅ All have values
        saveOrder();
        justprint();
    } else {
        toastr.error('Please fill all fields before printing.', 'Error');
    }
}

function disableButtons() {
    $('#saveOrder').prop('disabled', true).addClass('opacity-50 cursor-not-allowed');
    $('#JustPrint').prop('disabled', true).addClass('opacity-50 cursor-not-allowed');
    $('#Print').prop('disabled', true).addClass('opacity-50 cursor-not-allowed');
}

function enableButtons() {
    $('#saveOrder').prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
    $('#JustPrint').prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
    $('#Print').prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
}

</script>
@endsection