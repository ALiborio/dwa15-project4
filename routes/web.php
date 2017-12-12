<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

# Home
Route::get('/', function() {
    return view('welcome');
})->name('home');

Route::group(['middleware' => 'auth'], function () {
    # Create/Store
    Route::get('/character/new', 'CharacterController@create')->name('characterCreate');
    Route::post('/character', 'CharacterController@store');
    Route::get('/race/new', 'RaceController@create')->name('raceCreate');
    Route::post('/race', 'RaceController@store');
    Route::get('/class/new', 'ProfessionController@create')->name('professionCreate');
    Route::post('/class', 'ProfessionController@store');

    # Edit/Update
    Route::get('/character/{id}/edit', "CharacterController@edit")->name('characterEdit');
    Route::put('/character/{id}', "CharacterController@update");
    Route::get('/race/{id}/edit', "RaceController@edit")->name('raceEdit');
    Route::put('/race/{id}', "RaceController@update");
    Route::get('/class/{id}/edit', "ProfessionController@edit")->name('professionEdit');
    Route::put('/class/{id}', "ProfessionController@update");

    # Delete
    Route::get('/character/{id}/delete', "CharacterController@delete")->name('characterDelete');
    Route::delete('/character/{id}', "CharacterController@destroy");
    Route::get('/race/{id}/delete', "RaceController@delete")->name('raceDelete');
    Route::delete('/race/{id}', "RaceController@destroy");
    Route::get('/class/{id}/delete', "ProfessionController@delete")->name('professionDelete');
    Route::delete('/class/{id}', "ProfessionController@destroy");
});

# Search/Show
Route::get('/character/', "CharacterController@index")->name('characterIndex');
Route::get('/character/search', "CharacterController@search")->name('characterSearch');
Route::get('/character/{id}', "CharacterController@show")->name('characterShow');

Route::get('/race/', "RaceController@index")->name('raceIndex');
Route::get('/race/search', "RaceController@search")->name('raceSearch');
Route::get('/race/{id}', "RaceController@show")->name('raceShow');

Route::get('/class/', "ProfessionController@index")->name('professionIndex');
Route::get('/class/search', "ProfessionController@search")->name('professionSearch');
Route::get('/class/{id}', "ProfessionController@show")->name('professionShow');

#Database Debug function
Route::get('/debug', function () {

    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});

Auth::routes();
