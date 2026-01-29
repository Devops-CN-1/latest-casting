<?php


use App\Htt\Controllers\API\PartyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
});

Route::group(['namespace' => 'App\Http\Controllers\API'], function () {
    // --------------- Register and Login ----------------//
    Route::post('register', 'AuthenticationController@register')->name('register');
    Route::post('login', 'AuthenticationController@login')->name('login');
    
    // ------------------ Get Data ----------------------//
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('get-user', 'AuthenticationController@userInfo')->name('get-user');
        Route::post('logout', 'AuthenticationController@logOut')->name('logout');
        Route::post('add-party','PartyController@store')->name('add-party');
        Route::post('get-stock-data','StockController@getStockData');
        Route::post('add-exp-sona','StockController@addExpSona'); 
        Route::post('add-exp-cash','StockController@addExpCash'); 
        Route::post('sell-sona','StockController@sellSona');
        Route::post('buy-sona','StockController@buySona');
        Route::get('expense-gold-list','StockController@expenseGoldList');
        Route::get('expense-cash-list','StockController@expenseCashList');
        Route::get('stock-gold-list','StockController@stockGoldList');
        Route::get('stock-cash-list','StockController@stockCashList');
        Route::get('leena-Cash-Gold','StockController@leenaPartiesSummary');
        Route::get('show-All-Records','StockController@showAllRecords');
        Route::get('deena-Cash-Gold','StockController@deenaPartiesSummary');
        Route::get('stock-total','StockController@stockTotal');
        Route::post('Enter-gold-cash-stock','StockController@enteGoldCashStock');
        Route::post('old-record','StockController@oldRecord');
        Route::get('max-order','StockController@maxOrder');
        Route::get('max-waste','StockController@maxWaste');
        Route::post('store-party-advance','PartyController@storePartyAdvance')->name('store-party-advance');
        Route::get('all-parties','PartyController@index')->name('all-parties');
        Route::get('parties/{party}','PartyController@show');
        Route::get('/get-parties-status','PartyController@getPartiesStatus');
        Route::get('party/old-parchi/{party}','PartyController@oldparchies');
        Route::get('party/orderRecord/{party}','PartyController@orderRecord');
        Route::get('getLastOrderInformation','OrderController@getLastOrderInformation');
        Route::post('add-party','PartyController@store')->name('add-party');
        Route::middleware('super.admin.api')->group(function () {
            Route::post('system-settings/save','SystemSettingController@save')->name('system-settings.save');
            Route::post('system-settings/update-rates','SystemSettingController@updateRates')->name('system-settings.update-rates');
        });
        // Route::post('parties/{party}', 'PartyController@update');
        Route::put('party/{party}', 'PartyController@update');
        // Route::post('ab/{party}', 'PartyController@update');
        Route::delete('/parties/{id}', 'PartyController@destroy');
        Route::post('order','OrderController@store');
        Route::get('parties/type/regular','PartyController@getRegularParties');
        Route::get('parties/type/cash','PartyController@getCashParties');
    });

});
