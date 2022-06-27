<?php

use Illuminate\Support\Facades\Route;

Route::name('jCalendar.')
	->namespace('Juarismi\Calendar\Http\Controllers')
	->middleware(['cors', 'api'])
	->prefix('calendar')
	->group(function(){

	Route::apiResources([
	    'agenda' => 'AgendaController',
	]);

});

