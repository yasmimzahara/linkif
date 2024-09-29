<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Student;
use App\Http\Controllers\Company;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsStudent;
use App\Http\Middleware\IsCompany;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    switch (\Auth::user()->type) {
    case 'admin': return view('admin/dashboard');
    case 'company': return view('company/dashboard');
    case 'student': return view('student/dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => [IsAdmin::class]], function(){
        Route::name('admin.')->group(function () {
            Route::resource('admin/applications', Admin\ApplicationsController::class)->except(['show']);
            Route::resource('admin/courses', Admin\CoursesController::class)->except(['show']);
            Route::resource('admin/internships', Admin\InternshipsController::class)->except(['show']);

            Route::resource('admin/admins', Admin\AdminsController::class)->except(['show']);
            Route::get(
                'admin/admins/{admin}/password',
                [Admin\AdminsController::class, 'editPassword']
            )->name('admins.editPassword');
            Route::match(
                ['put', 'patch'],
                'admin/admins/{admin}/password',
                [Admin\AdminsController::class, 'updatePassword']
            )->name('admins.updatePassword');

            Route::resource('admin/companies', Admin\CompaniesController::class)->except(['show']);
            Route::get(
                'admin/companies/{company}/password',
                [Admin\CompaniesController::class, 'editPassword']
            )->name('companies.editPassword');
            Route::match(
                ['put', 'patch'],
                'admin/companies/{company}/password',
                [Admin\CompaniesController::class, 'updatePassword']
            )->name('companies.updatePassword');

            Route::resource('admin/students', Admin\StudentsController::class)->except(['show']);
            Route::get(
                'admin/students/{student}/password',
                [Admin\StudentsController::class, 'editPassword']
            )->name('students.editPassword');
            Route::match(
                ['put', 'patch'],
                'admin/students/{student}/password',
                [Admin\StudentsController::class, 'updatePassword']
            )->name('students.updatePassword');
        });
    });

    Route::group(['middleware' => [IsStudent::class]], function(){
        Route::name('student.')->group(function () {
            Route::get('student/resumes', [Student\ResumesController::class, 'edit'])->name('resumes.edit');
            Route::get('student/resume/download', [Student\ResumesController::class, 'download'])->name('resumes.download');
            Route::match(
                ['put', 'patch'],
                'student/resumes',
                [Student\ResumesController::class, 'update']
                )->name('resumes.update');

            Route::resource('student/internships', Student\InternshipsController::class)->only(['index']);
            Route::post(
                'student/internships/{internship}/apply',
                [Student\InternshipsController::class, 'apply']
            )->name('internships.apply');
        });
    });

    Route::group(['middleware' => [IsCompany::class]], function(){
        Route::name('company.')->group(function () {
            Route::resource('company/internships', Company\InternshipsController::class);
            Route::get(
                'student/internships/{internship}/applications',
                [Company\InternshipsController::class, 'applications']
            )->name('internships.applications');
        });
    });
});

require __DIR__.'/auth.php';
