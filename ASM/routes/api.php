<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommandeController;
use Illuminate\Support\Facades\DB;
use App\Models\Commande;
use App\Http\Controllers\EmailController;
use App\Models\User;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\EventController;

//route pour authentificaton

Route::post('/users/register', 'App\Http\Controllers\UserController@register');

Route::middleware('auth:api')->post('/users/logout', [UserController::class, 'logout']);

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::post('/users/login', [UserController::class, 'login']);
});
// Route for sending password reset email
Route::post('password/email', [UserController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset', [UserController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('password/reset', [UserController::class, 'resetPassword']);
Route::post('avatar/update', [UserController::class, 'updateAvatar']);
//route pour Event 



Route::get('/events', [EventController::class, 'getEvents']);
Route::post('/add-event', [EventController::class, 'addEventToCalendar']);
Route::put('/update-event/{id}', [EventController::class, 'updateEvent']);
Route::delete('/delete-event/{id}', [EventController::class, 'deleteEvent']);







Route::get('/produits', [ProduitController::class, 'index']);
Route::get('/produits/{id}', [ProduitController::class, 'show']);
Route::post('/produits', [ProduitController::class, 'store']);
Route::put('/produits/{id}', [ProduitController::class, 'update']);
Route::delete('/produits/{id}', [ProduitController::class, 'destroy']);

Route::post('/produits/delete-multiple', [ProduitController::class, 'deleteMultiple']);


//route pour user de mois
Route::get('/users/{userId}/completed-orders/count', [UserController::class, 'getNumberOfCompletedOrders']);

// Routes pour la gestion des utilisateurs
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('/users/{user}/edit', [UserController::class, 'edit']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);
Route::get('/users/sorted-by-period', [UserController::class, 'showUsersByPeriod']);


Route::get('/users', function () {
    
    return User::all();
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Routes pour la gestion des commandes
Route::get('/commandes', function () {
    $commandes = Commande::all();
    return $commandes;
});
Route::put('/commandes/{id}/update-status', [CommandeController::class, 'updateStatus']);
Route::get('/commandes/status/{status}', [CommandeController::class, 'getByStatus']);
Route::post('/commandes/{id}/affecter-commande', [CommandeController::class, 'affecterCommande']);
Route::put('/commandes/{id}/reject-commande', [CommandeController::class, 'rejectCommande']);
Route::put('/commandes/{id}/affect-commande', [CommandeController::class, 'affecteCommande']);
Route::get('/commandes/summary', 'App\Http\Controllers\CommandeController@summary');
Route::get('/commandes/en-attente', [CommandeController::class, 'getEnAttente']);
Route::post('/commandes/{id}/termine-commande', [CommandeController::class, 'termineCommande']);




// route pour send-mail
Route::post('send-email', [EmailController::class, 'sendEmail']);
Route::post('send-mail-terminee', [EmailController::class, 'sendMailTerminee']);
Route::post('send-mail-rejetee', [EmailController::class, 'sendMailRejetee']);
Route::post('send-meilleur-ouvrier-email', [EmailController::class,'sendMeilleurOuvrierEmail']);












