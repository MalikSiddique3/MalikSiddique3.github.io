<?php

use App\Http\Controllers\RiskAnalysisController;
use App\Models\question;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (HttpRequest $request) {
    if(isset($request->id))
    {
       
        $id = question::find(\DB::table('question')->max('id'));
       
        if($id->id >= $request->id)
        {
        $question = question::where('id',$request->id)->first();
        }
        else
        {
            return redirect('/thankyou');
        }
    }
    else
    {
        $question = question::where('id','1')->first();
    }
   
    return view('index',['question' => $question]);
});
Route::get('genrate', [RiskAnalysisController::class, 'show']);
Route::get('/thankyou', function () {
    return view('thankyou');
});
Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit']);
Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'update']);
Route::get('/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete']);
Route::get('/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete']);
Route::get('/addquestions', [App\Http\Controllers\HomeController::class, 'add']);
Route::post('/store', [App\Http\Controllers\HomeController::class, 'store']);