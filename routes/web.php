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

Route::get('/', 'cpController@welcom');

Route::post('postTest','postController@store');
Route::get('testpage', function(){
    $data = null;
    return view('test', ['users' => $data]);    
});
Route::post('testpage', 'postController@test');

Auth::routes();

Route::get('/home', function(){
    return redirect('myspace');    
});

Route::get('/myspace', 'cpController@index');
// Route::match(['get', 'post'], '/expedit/{expid}','cpController@edit');
Route::match(['get', 'post'], '/infoedit/{userid}','cpController@info_edit');
Route::match(['get', 'post'], '/eduedit/{eduid}', 'cpController@edu_edit');
Route::match(['get', 'post'], '/expedit/{expid}', 'cpController@exp_edit');
Route::match(['get', 'post'], '/recedit/{recid}', 'cpController@rec_edit');
Route::post('/expdelete/{expid}', 'cpController@exp_delete');
Route::post('/edudelete/{eduid}', 'cpController@edu_delete');
Route::post('/recdelete/{recid}', 'cpController@rec_delete');
Route::get("addExpform",'cpController@exp_store');
Route::get("addEduform",'cpController@edu_store');
Route::get("addRecruit",'cpController@rec_store');
Route::get("editEduform",'cpController@edu_change');
Route::get("editExpform",'cpController@exp_change');
Route::get("editINFOform",'cpController@info_change');
Route::get("editRecform", 'cpController@rec_change');
Route::get("recruit", 'cpController@show_recruit');
Route::match(['get', 'post'], '/sendcv/{recid}', 'cpController@sendcv');
// Route::post('/addExpform/create', 'cpController@info_edit');

?>