<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {


        Route::get('/', [HomeController::class, 'index'])->name('dashboard');


        //Grade
        Route::resource('grade', GradeController::class);

        //Classroom
        Route::resource('classroom', ClassroomController::class);
        Route::post('classroom/delete-all', [ClassroomController::class, 'deleteAll'])->name('classroom.deleteAll');
        Route::post('classroom/filter-classes', [ClassroomController::class, 'Filter_Classes'])->name('classroom.filter-classes');

        //sections
        Route::resource('sections', SectionController::class);
        Route::post('sections.getClass', [SectionController::class, 'getClass'])->name('section.getClass');

        //Add Parent
        Route::view('add_parent', 'livewire.showForm')->name('add_parent');

        //Teachers
        Route::get('teachers',[TeacherController::class,'index'])->name('teachers.index');
    }
);

require __DIR__ . '/auth.php';
