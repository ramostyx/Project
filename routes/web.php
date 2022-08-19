<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Teacher\GroupController;
use App\Http\Controllers\Teacher\StudentController;
use App\Http\Controllers\Teacher\SubjectController;
use Illuminate\Support\Facades\Route;

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

Route::get('/test', function () {
    return view('Groups.edit');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('groups', GroupController::class)->except([
    'create', 'show'
])->middleware(['auth']);

Route::resource('groups.students', StudentController::class);
Route::resource('groups.subjects', SubjectController::class);
Route::get('groups/{group}/details',[GroupController::class,'details'])->name('group.details');
Route::get('groups/students',[GroupController::class,'students']);

Route::get('student/groups', function () {
    return view('Student.Groups.index');
})->middleware(['auth','role:student']);
Route::post('student/group/join',[StudentController::class,'join'])->name('groups.students.join');

Route::middleware(['auth','role:teacher'])->group(function(){
    Route::get('/Notification', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/mark-as-read', [NotificationController::class, 'markNotification'])->name('markNotification');
});
require __DIR__.'/auth.php';
