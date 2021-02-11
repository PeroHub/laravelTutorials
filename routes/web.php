<?php

use Dotenv\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    $task = Task::orderBy('created_at', 'asc')->get();

    return view('task', [
        'task' => $tasks
    ]);
});

// Route::get('/', function () {
//     return view('tasks');
// });



Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});
    

Route::delete('/task/{id}', function ($id) {
    Task::findorFail($id)->delete();

    return redirect('/');
});

// Route::get('/task', function () {
//     return view('tasks');

// });
