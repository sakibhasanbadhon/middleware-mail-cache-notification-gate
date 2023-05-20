<?php

use App\Models\User;
use GuzzleHttp\Middleware;
use App\Jobs\NotificationJob;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function(){

    // cache er code
    // $data=[
    //     'name'     => 'Sakib',
    //     'email'    => 'arif@gmailgmail.com',
    //     'password' => 12345678
    // ];

    //Cache::put('user_data',$data,now()->addMinutes(1));

    // dd(Cache::get('user_data'));

    return view('welcome');
});


// Notification part

Route::get('/notification', function(){

    //queue er maddhome data pathanor jonno
    //dispatch(new NotificationJob)->delay(now()->addSeconds(10));

    $data = [
        'product_name'=>'Laptop',
        'invoice_no'=>'INN-012',
        'price'=>552,
    ];


    User::find(15)->notify(new InvoicePaid($data));


    return back();
});

Route::get('mark-read', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return back();
});



Route::get('{id}/up',[HomeController::class, 'up'])->name('up');






// Route::get('/home', function(){
//     $students = DB::table('student')->get();
//     return view('home',['student'=>$students]);
// });

// Route::get('/insert', function () {
//     $students = DB::table('student')->insert([
//         'name'    => 'Shohag Hamja',
//         'roll'    => '1451',
//         'address' => 'Dinajpur',
//         'created_at'=> now(),
//         'updated_at'=> now()

//     ]);

//     if ($students == true) {
//         return "Data Saved";
//     } else {
//         return "Data Save Faild";
//     }


// });



// Route::get('/student', function () {


//     $students = DB::table('student')->where('status',1)->first();

//     return $students;
//     return view('home',['student'=>$students]);


// });



// Route::get('/student', function () {


    //     DB::table('student')->where('id',10)->update([
    //         'name'=>'Sakib Hasan',
    //         'roll'=> 455347,
    //         'address'=>'hajradighi'
    //     ]);

    //     $students= DB::table('student')->get();
    //     return view('home',['student'=>$students]);


// });



Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');



//  Login And Email Verification kore aste hobe

Route::group(['middleware'=>['auth','email_verify']], function(){
    Route::get('profile',[App\Http\Controllers\HomeController::class, 'profile']);



});


// avabeo group routekora jay // kono akta middleware ke ignore kora jay

// Route::middleware(['auth', 'email_verify'])->group(function () {
//     Route::get('profile',[App\Http\Controllers\HomeController::class, 'profile']);

// });



Route::post('file/upload',[App\Http\Controllers\HomeController::class, 'upload'])->name('file.upload');

