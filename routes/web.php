<?php

use App\Http\Controllers\ConversationsController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\PrivateMessagesController;
use App\Models\relationships;
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

Route::get('/', function () {
    redirect()->route('login');
})->name('homePage');
Route::post('/send', [PrivateMessagesController::class, 'send']);
Route::post('/findFriend', [homeController::class, 'findFriend']);
Route::post('/receive', [PrivateMessagesController::class, 'receive']);
Route::post('/getNotif', [PrivateMessagesController::class, 'getNotif']);
Route::get('login', [loginController::class, 'index'])->name('login');
Route::post('authenticate', [loginController::class, 'authenticate']);
Route::get('channels', [loginController::class, 'defaultRedirect']);
Route::get('register', [loginController::class, 'register'])->name('register');
Route::post('register', [loginController::class, 'add']);
Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'h', 'namespace' => 'h'], function () {
        Route::get('/addFriend', [homeController::class, 'addFriend'])->name('add_friend');
        Route::get('/emotes', [homeController::class, 'emotesPage'])->name('emotes_page');
        Route::get('/pending_friend', [homeController::class, 'pending'])->name('pendingFriends');
        Route::get('/sendRequest/{id}', [homeController::class, 'sendFriendRequest']);
        Route::get('/acceptrequest/{id}', [homeController::class, 'acceptFriendRequest']);
        Route::get('/cancelreuest/{id}', [homeController::class, 'denyFriendRequest']);
        Route::get('/denyrequest/{id}', [homeController::class, 'denyFriendRequest']);
        Route::get('/logout', [loginController::class, 'logout'])->name('logout');
        Route::get('@me', [homeController::class, 'index'])->name('newHomePage');
        Route::get('chat/{userId}', [PrivateMessagesController::class, 'index'])->name('direct_message');
        Route::get('send-message/{id}', [PrivateMessagesController::class, 'createConversation']);
        Route::post('chat/{userId}/send', [PrivateMessagesController::class, 'send'])->name('');
        Route::post('chat/{userId}/get', [PrivateMessagesController::class, 'receive'])->name('');
        Route::get('server/{server_id}', [ConversationsController::class, 'index'])->name('loggedIn');
        Route::get('server/{server_id}/{channel_id}', [ConversationsController::class, 'index'])->name('loggedIn');
    });
});
