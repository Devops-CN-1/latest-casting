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
                    <input type="text"
                        class="w-full sm:flex-1 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white" />
                    <input type="text"
                        class="w-full sm:flex-1 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white" />
                    <label class="ml-2 p-1 w-20 text-center font-semibold bg-[#804000] text-[#f1da69]">پارٹی
                        نمبر</label>
                </div>
                <div class="w-1/2 flex gap-5 items-center">
                    <input type="text"
                        class="w-full sm:flex-1 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white" />
                    <label class="ml-2 p-1 w-20 text-center font-semibold bg-[#804000] text-[#f1da69]">پارٹی نام</label>
                </div>
                <div class="">
                    <button
                        class="p-1 font-bold bg-[#80ff80] border-2 border-l-white border-t-white  border-r-[#b1b0aa] border-b-[#c9c8c4]">Old
                        Parchi</button>
                </div>
            </div>
            <!-- second input feilds column  -->
            <div class="mt-2 w-full flex items-center gap-5">
                <!-- input field -->
                <div class="w-1/4 flex items-center">
                    <input type="text"
                        class="w-full sm:flex-1 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                    <label class="ml-2 p-1 w-28 text-center font-semibold bg-[#000040] text-[#f1da69]">وزن
                        کاسٹنگ</label>
                </div>
                <!-- checkoxes -->
                <div class="w-1/6 flex justify-center">
                    <div
                        class="px-1 flex items-center cursor-pointer space-x-2 bg-[#800000] text-white border border-black">
                        <span class="h-8">پیس</span>
                        <input type="checkbox" class="">
                    </div>
                    <div
                        class="px-1 flex items-center cursor-pointer space-x-2 bg-[#800000] text-white border border-black">
                        <span class="h-8">اندر</span>
                        <input type="checkbox" class="">
                    </div>
                </div>
                <!-- input field  -->
                <div class="w-1/4 flex items-center gap-4">
                    <input type="text"
                        class="w-full sm:flex-1 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                    <label class="ml-2 p-1 w-20 text-center font-semibold bg-[#804000] text-[#f1da69]">میل کوڈ</label>
                </div>
                <!-- input field  -->
                <div class="w-1/3 flex items-center gap-4">
                    <input type="text"
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
                        <input type="text"
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="text"
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="text"
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="text"
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="text"
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="text"
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="text"
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        <input type="text"
                            class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                    </div>

                    <!-- Labels Panel -->
                    <div class="w-1/2 flex flex-col items-center p-1 font-semibold bg-[#804000] text-[#f1da69]">
                        <span class="text-blue-100">Wapsi</span>
                        <span class="text-blue-100 mt-2">Net Weight</span>
                        <span class="mt-2">ویسٹ</span>
                        <span class="mt-2">کُل وزن</span>
                        <span class="mt-4">میل نکالا</span>
                        <span class="mt-3">خالص</span>
                        <span class="mt-2">ایڈوانس</span>
                        <span class="mt-3">کل خالص</span>
                    </div>
                </div>
                <div class="w-[40%]">
                    <!-- center input types -->
                    <div class="flex gap-2">
                        <!-- Input Fields -->
                        <div class="w-1/3 flex">
                            <input type="text"
                                class="w-full h-7 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                            <input type="text"
                                class="w-full h-7 outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        </div>
                        <div class="w-1/3 flex flex-col space-y-2">
                            <input type="text"
                                class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                            <input type="text"
                                class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                            <input type="text"
                                class="w-full outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                        </div>

                        <!-- Labels Panel -->
                        <div class="text-center bg-[#800000] text-[#f1da69] font-semibold w-1/3">
                            <span class="block">مزدوری</span>
                            <span class="mt-2 block">سابقہ مزدوری</span>
                            <span class="mt-2 block">کل مزدوری</span>
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
                                <input type="text"
                                    class="w-1/2 h-7 bg-[#ff0000] outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                                <input type="text"
                                    class="w-1/2 h-7 bg-[#ffc0c0] outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox"
                                    class="w-1/6 h-7 bg-white outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                                <input type="text"
                                    class="w-5/12 h-7 bg-[#ff0000] outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                                <input type="text"
                                    class="w-5/12 h-7 bg-[#ffc0c0] outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                            </div>
                            <div>
                                <input type="text"
                                    class="w-full h-7 bg-[#ffc0c0] outline-none shadow-inner border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  />
                            </div>
                            <div>
                                <input type="text"
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
                        <input class="w-1/2 outline-none shadow-inner bg-[#d8e4f8] border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  type="text">
                    </div>
                    <div class="flex items-center text-sm gap-1 mt-2">
                        <input class="w-1/4 outline-none shadow-inner border-2 bg-[#ffc0ff] border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  type="text">
                        <label class="p-1 w-32 text-center font-semibold bg-[#400040] text-[#f1da69]" for="">پارٹی بل</label>
                        <input class="w-1/4 outline-none shadow-inner border-2 bg-[#ffc0ff] border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white"  type="text">
                        <label class="p-1 w-32 text-center font-semibold bg-[#400040] text-[#f1da69]" for="">سیریل نمبر</label>
                    </div>
                    <div class="mt-2">
                        <input class="w-full outline-none shadow-inner bg-[#ffc0c0] border-2 border-l-[#8d8d7d] border-t-[#9c9d8a] border-r-[b5b5a8] border-b-white bg-white text-center font-semibold" type="text" value="07/MAY/2025">
                    </div>
                </div>
            </div>
            <!-- bottok Section -->
            <div class="mt-2 grid grid-cols-3 gap-2 text-sm border-2 border-black p-2">

                <!-- Box 1 -->
                <div class="">
                    <div class="bg-[#804000] text-[#f1da69] px-2 py-1 -t flex justify-between">
                        <input type="radio" name="payment_type" class="ml-1">
                        <span>مزدوری----سونا</span>
                        <span> </span>

                    </div>
                    <div class="mt-1 space-y-2">
                        <div class="flex items-center">
                            <label class="w-32 font-bold text-right text-[#f1da69] bg-[#804000]"> خالص</label>
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="text" />
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="text" />
                            <label class="w-32 font-bold text-left text-[#f1da69] bg-[#804000]">مزدوری</label>
                        </div>


                        <div class="flex items-center">
                            <label class="w-32 font-bold text-right text-[#f1da69] bg-[#804000]"> وصول کیا</label>
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="text" />
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="text" />
                            <label class="w-32 font-bold text-left text-[#f1da69] bg-[#804000]"> وصول کیا</label>
                        </div>

                        <div class="flex items-center">
                            <label class="w-32 font-bold text-right text-[#f1da69] bg-[#804000]">واپس دیا</label>
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="text" />
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="text" />
                            <label class="w-32 font-bold text-left text-[#f1da69] bg-[#804000]">واپس دیا</label>
                        </div>

                        <div class="flex items-center">
                            <label class="w-16 font-bold text-right text-[#f1da69] bg-[#804000]">بقایا</label>
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="text" />
                            <input class="w-1/2 border  text-right px-1 bg-[#ffff80]" type="text" />
                            <label class="w-16 font-bold text-left text-[#f1da69] bg-[#804000]"> بقایا</label>
                        </div>
                    </div>
                </div>

                <div class="border-l-2 border-dashed border-black pl-2">
                    <div class="bg-[#800000] text-[#f1da69] px-2 py-1 -t flex justify-between">
                        <input type="radio" name="payment_type" class="ml-1">
                        <span>سونا----سونا</span>
                        <span> </span>

                    </div>
                    <div class="mt-1 space-y-2 ">
                        <div class="flex items-center">
                            <input class="w-1/3 border  px-1 bg-[#c0c0ff]" type="text" />
                            <input class="w-1/3 border  px-1 bg-[#c0c0ff]" type="text" />
                            <input class="w-1/3 border  px-1 bg-[#c0c0ff]" type="text" />
                        </div>


                        <div class="flex items-center">
                            <input class="w-1/2 border  px-1 bg-[#c0c0ff]" type="text" />
                            <label class="w-32 font-semibold text-center text-[#f1da69] bg-[#800000]"> وصول کیا</label>
                            <label class="w-32 font-semibold text-center text-[#f1da69] bg-[#800000] ml-1"> وصول کیا</label>
                            <input class="w-1/2 border  px-1 bg-[#c0c0ff]" type="text" />
                        </div>

                        <div class="flex items-center">
                            <input class="w-1/2 border  px-1 bg-[#c0c0ff]" type="text" />
                            <label class="w-32 font-semibold text-center text-[#f1da69] bg-[#800000]">واپس دیا</label>
                            <label class="w-32 font-semibold text-center text-[#f1da69] bg-[#800000] ml-1">واپس دیا</label>
                            <input class="w-1/2 border  px-1 bg-[#c0c0ff]" type="text" />
                        </div>

                        <div class="flex items-center">
                            <input class="w-1/2 border  px-1 bg-[#c0c0ff]" type="text" />
                            <label class="w-16 font-semibold text-center text-[#f1da69] bg-[#800000]"> بقایا</label>
                            <label class="w-16 font-semibold text-center text-[#f1da69] bg-[#800000] ml-1"> بقایا</label>
                            <input class="w-1/2 border  px-1 bg-[#c0c0ff]" type="text" />
                        </div>
                    </div>
                </div>

                <!-- Box 3 -->
                <div class="border-l-2 border-dashed border-black pl-2">
                    <div class="bg-[#400040] text-[#f1da69] px-2 py-1 flex justify-between">
                        <input type="radio" name="payment_type" class="ml-1">
                        <span>کیش----کیش</span>
                        <span> </span>

                    </div>
                    <div class="mt-1 space-y-2">
                        <div class="flex items-center">
                            <input class="w-1/3 border  text-right px-1 bg-[#ffc0c0]" type="text" />
                            <input class="w-1/3 border  text-right px-1 bg-[#ffc0c0]" type="text" />
                            <input class="w-1/3 border  text-right px-1 bg-[#ffc0c0]" type="text" />
                        </div>


                        <div class="flex items-center justify-end">
                            <label class="w-20 font-bold text-center bg-[#400040] text-[#f1da69]"> وصول کیا</label>
                            <input class="w-1/2 border  px-1 bg-[#ffc0c0]" type="text" />
                        </div>

                        <div class="flex items-center justify-end">
                            <label class="w-20 font-bold text-center bg-[#400040] text-[#f1da69]">واپس دیا</label>
                            <input class="w-1/2 border  px-1 bg-[#ffc0c0]" type="text" />
                        </div>

                        <div class="flex items-center justify-end">
                            <label class="w-20 font-bold text-center bg-[#400040] text-[#f1da69]"> بقایا</label>
                            <input class="w-1/2 border  px-1 bg-[#ffc0c0]" type="text" />
                        </div>
                    </div>
                </div>

            </div>
            <div class="w-full flex gap-5 mt-2">
                <!-- Branding & Time -->
                <div
                    class="w-[40%] flex justify-between items-center bg-green-400 p-2 text-white text-xl font-serif italic">
                    <div>{{ $systemSettings->software_name}}</div>

                </div>

                <!-- Bottom Buttons -->
                <div class="w-3/5">
                    <div class="flex items-center justify-between">
                        <span class="w-1/3text-black font-mono text-xl font-bold">8:15:27 PM</span>
                        <select class="w-4/6 bg-white text-black border border-gray-300">
                            <option value=""></option>
                            <option value="1">آپشن 1</option>
                            <option value="2">آپشن 2</option>
                            <option value="3">آپشن 3</option>
                          </select>
                    </div>
                    <div>
                        <button class="bg-amber-100 text-black py-1 w-20">JustPrint</button>
                        <button class="bg-stone-500 py-1 w-20">Save</button>
                        <button class="bg-pink-200 text-black py-1 w-20">Print</button>
                        <button class="bg-red-600 py-1 w-20">Clear</button>
                        <a href = "{{route('party.create.form')}}" ><button class="bg-green-100 text-black py-1 w-20">Parties</button></a>
                        <a href="{{url('advance')}}" class="bg-orange-400 text-black py-1 w-20">Advance</a>
                        <button class="bg-pink-400 text-black py-1 w-20">Exit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection