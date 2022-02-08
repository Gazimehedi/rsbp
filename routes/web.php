<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RsvpController;

Route::get('/', [RsvpController::class,'index']);
Route::post('/cardcodecheck', [RsvpController::class,'cardcodecheck'])->name('cardcodecheck');
Route::get('/perticipantsdetails/{cardcode}', [RsvpController::class,'perticipantdetails'])->name('perticipantdetails');
Route::post('updateperticipation/{id}', [RsvpController::class,'updateperticipation'])->name('updateperticipation');
Route::get('comment/{id}', [RsvpController::class,'comment'])->name('comment');
Route::post('commentupdate/{id}', [RsvpController::class,'commentupdate'])->name('commentupdate');
