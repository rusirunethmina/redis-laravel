<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use App\Jobs\SendTestMailJob;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redis', function () {
    Redis::hmset('user', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
    return Redis::hgetall('user');
});




Route::get('/test-queue', function () {
    $email = 'rusiruc21@gmail.com'; // Replace with your test email
    $messageContent = 'This is a test email sent via Redis queue.';

    // Dispatch the job
    SendTestMailJob::dispatch($email, $messageContent);

    return 'Test email job dispatched!';
});
