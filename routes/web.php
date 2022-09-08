<?php

use App\Http\Controllers\AssignmentsController;
use App\Http\Controllers\LessonsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Teacher\GradeController;
use App\Http\Controllers\Teacher\GroupController;
use App\Http\Controllers\Teacher\StudentController;
use App\Http\Controllers\Teacher\SubjectController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth','role:teacher'])->prefix('teacher')->name('teacher.')->group(function(){
});


Route::middleware('auth')->group(function(){
    //Dashboard
    Route::get('/dashboard', function () {
        if(Auth::user()->hasRole('teacher'))
            return view('Teacher.dashboard');
        return view('Student.dashboard');
    })->name('dashboard');

    //Groups
    Route::resource('groups', GroupController::class)->except([
        'create', 'show'
    ]);
    Route::get('groups/{group}/details',[GroupController::class,'details'])->name('group.details');
    Route::post('student/group/join',[StudentController::class,'join'])->name('groups.students.join');

    //Subjects
    Route::resource('groups.subjects', SubjectController::class);

    //Grades
    Route::get('groups/{group}/grades/{semester?}/{evaluation?}',[GroupController::class, 'grades'])->name('grades');
    Route::get('groups/{group}/students/{student}/grades/{semester?}/{evaluation?}',[StudentController::class, 'Indexgrades'])->name('grades.create');
    Route::post('groups/{group}students/{student}/grades',[StudentController::class, 'Storegrades'])->name('grades.store');
    Route::delete('groups/{group}students/{student}/grades/{semester}/{evaluation}',[StudentController::class, 'Deletegrades'])->name('grades.delete');
    Route::get('groups/{group}/grades/search/{semester?}/{evaluation?}',[GroupController::class, 'search'])->name('grades.search');

    //Notifications
    Route::get('/Notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/mark-as-read', [NotificationController::class, 'markNotification'])->name('markNotification');

    //Assignments
    Route::resource('groups.subjects.assignments',AssignmentsController::class);
    Route::get('groups/subjects/assignments/redirect/{gId?}',[AssignmentsController::class,'redirect'])->name('assignments.redirect');
    Route::post('assignments/{assignment}/comment',[AssignmentsController::class,'postComment'])->name('assignment.comment.post');
    Route::delete('comments/{comment}',[AssignmentsController::class,'deleteComment'])->name('comment.delete');
    Route::delete('attachments/{attachment}',[AssignmentsController::class,'deleteAttachment'])->name('attachment.delete');

    //Lessons
    Route::get('groups/subjects/lessons/redirect/{gId?}',[LessonsController::class,'redirect'])->name('groups.subjects.lessons.redirect');
    Route::resource('groups.subjects.lessons',LessonsController::class);
    //Attachments
    Route::get('attachments/{attachment}',[AssignmentsController::class,'download'])->name('download');


});
require __DIR__.'/auth.php';


/*
Route::get('/dashboard', function () {
    if(Auth::user()->hasRole('teacher'))
        return view('dashboard');
    return 'dashboard';
})->middleware(['auth','role:teacher'])->name('dashboard');

Route::resource('groups', GroupController::class)->except([
    'create', 'show'
])->middleware(['auth']);
Route::resource('groups.subjects.assignments',AssignmentsController::class);
Route::get('groups/subjects/assignments/redirect',[AssignmentsController::class,'redirect'])->name('groups.subjects.assignments.redirect');
Route::resource('groups.subjects.lessons',LessonsController::class);
Route::get('groups/subjects/lessons/redirect',[LessonsController::class,'redirect'])->name('groups.subjects.lessons.redirect');
Route::post('assignments/{assignment}/comment',[AssignmentsController::class,'postComment'])->name('assignment.comment.post');
Route::delete('comments/{comment}',[AssignmentsController::class,'deleteComment'])->name('comment.delete');
Route::resource('groups.students', StudentController::class);
Route::resource('groups.subjects', SubjectController::class);
Route::get('groups/{group}/details',[GroupController::class,'details'])->name('group.details');
Route::get('groups/students',[GroupController::class,'students']);
Route::get('attachments/{attachment}',[AssignmentsController::class,'download'])->name('download');

Route::get('student/groups', function () {
    return view('Student.Groups.index');
})->middleware(['auth','role:student'])->name('student.groups');
Route::post('student/group/join',[StudentController::class,'join'])->name('groups.students.join');



Route::middleware(['auth','role:teacher'])->group(function(){
    Route::get('/Notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/mark-as-read', [NotificationController::class, 'markNotification'])->name('markNotification');
    Route::get('groups/{group}/grades/search/{semester?}/{evaluation?}',[GroupController::class, 'search'])->name('grades.search');

    Route::get('groups/{group}/grades/{semester?}/{evaluation?}',[GroupController::class, 'grades'])->name('grades');
    Route::get('groups/{group}/students/{student}/grades/{semester?}/{evaluation?}',[StudentController::class, 'Indexgrades'])->name('grades.create');
    Route::post('groups/{group}students/{student}/grades',[StudentController::class, 'Storegrades'])->name('grades.store');
    Route::delete('groups/{group}students/{student}/grades/{semester}/{evaluation}',[StudentController::class, 'Deletegrades'])->name('grades.delete');


    //Route::put('groups/{group}/students/{student}/grades','update')->name('update');
        //Route::delete('groups/{group}/students/{student}/grades','delete')->name('delete');
});
*/
/*Route::controller(SubjectController::class)->middleware(['auth','role:teacher'])->name('assignments.')->group(function (){
    Route::get('groups/{group}/subjects/{subject}/assignments','assignmentsIndex')->name('index');
    Route::get('groups/{group}/subjects/{subject}/assignments/create','assignmentsCreate')->name('create');
    Route::post('groups/{group}/subjects/{subject}/assignments','assignmentsStore')->name('store');
    Route::get('groups/{group}/subjects/{subject}/assignments/{assignment}','assignmentsUpdate')->name('edit');
    Route::put('groups/{group}/subjects/{subject}/assignments/{assignment}','assignmentsUpdate')->name('update');
    Route::put('groups/{group}/subjects/{subject}/assignments/{assignment}','assignmentsDelete')->name('delete');
});*/

