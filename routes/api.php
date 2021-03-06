<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/checkin/start', function (Request $request) {
        // start an event
        $event = new \App\Event;
        $newEvent = $event->start($request->input('event'));
        return $newEvent;
    });

    Route::post('/checkin/search', function (Request $request) {
        // search for family
        $family = new \App\Family;
        $foundFamilies = $family->search($request->input('value'));
        return ['results' => $foundFamilies, 'count' => $foundFamilies->count()];
    });

});
