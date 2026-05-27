<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PSUController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentCoursesController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Middleware\DownForMaintenanceMw;
use App\Exports\StudentsExport;
use App\Exports\TeachersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ImageController;


// Route::get('/', function () {
//     return view('home');})->name('home')->middleware(DownForMaintenanceMw::class);
// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');




Route::get('/sessionUserAccount', [PagesController::class, 'SessionUserAccount']);

// Route::resource('/students', StudentsController::class)
// ->Middleware('sessionUserAccount');

// Route::middleware('group_middleware', DownForMaintenanceMw::class)->group(function () {
//     Route::resource('/degrees', DegreeController::class);
//     Route::resource('/students', StudentsController::class)->Middleware('sessionUserAccount');
//     Route::get('/user_profile', [PagesController::class, 'userProfile']);
//     Route::get('/user_posts', [PagesController::class, 'userPosts']);
//     Route::get('/student_courses', [PagesController::class, 'studentCourses']);
//     Route::get('/dashboard', function () { return view('home');})->name('dashboard');
//   //  Route::get('/', function () { return redirect('/dashboard'); });
// });
Route::middleware('group_middleware', 'maintenance', 'sessionUserAccount', 'forcePasswordChange', 'preventBackHistory')->group(function () {
    // Dashboard and main routes
    Route::get('/dashboard', [PagesController::class, 'adminDashboard'])->middleware('checkAdminRole')->name('dashboard');
    Route::get('/demo', [PagesController::class, 'demo'])->name('demo');
    Route::get('/teacher', [PagesController::class, 'teacherDashboard'])->name('teacher.dashboard');
    Route::get('/teacher/courses/enrolled-students', [PagesController::class, 'teacherEnrolledStudents'])->name('teacher.enrolled.students');
    Route::post('/teacher/avatar', [PagesController::class, 'uploadTeacherAvatar'])->name('teacher.avatar.upload');
    Route::get('/student/{student}', [PagesController::class, 'studentDashboard'])->name('student.dashboard');
    Route::post('/student/{student}/avatar', [PagesController::class, 'uploadStudentAvatar'])->name('student.avatar.upload');

    // Student courses (enroll in many courses)
    Route::get('/student/{student}/courses', [StudentCoursesController::class, 'index'])->name('student.courses.index');
    Route::post('/student/{student}/courses/{course}/enroll', [StudentCoursesController::class, 'enroll'])->name('student.courses.enroll');
    Route::delete('/student/{student}/courses/{course}/unenroll', [StudentCoursesController::class, 'unenroll'])->name('student.courses.unenroll');
    Route::get('/user_profile', [PagesController::class, 'userProfile']);
    Route::get('/user_posts', [PagesController::class, 'userPosts']);
    Route::post('/student_courses', [PagesController::class, 'studentCourses']);

   
    
    // Admin routes
    Route::get('/admins/create', [PagesController::class, 'createAdmin'])->name('admin.create');
    Route::post('/admins', [PagesController::class, 'storeAdmin'])->name('admin.store');
    
    // Teacher create/store routes (custom)
    Route::get('/teachers/create', [PagesController::class, 'createTeacher'])->name('teachers.create');
    Route::post('/teachers', [PagesController::class, 'storeTeacher'])->name('teachers.store');
    
    // Student list data for AJAX refresh (must be before resource route)
    Route::get('/students/list-data', [StudentsController::class, 'listData'])->middleware('checkAdminRole');
    
    // Teacher list data for AJAX refresh (must be before resource route)
    Route::get('/teachers/list-data', [TeachersController::class, 'listData']);
    
    // Resource routes
    Route::resource('/degrees', DegreeController::class);
    Route::resource('/courses', CourseController::class)->except(['show'])->middleware('checkAdminRole');
    Route::resource('/students', StudentsController::class)->middleware('checkAdminRole');
    Route::resource('/teachers', TeachersController::class)->except(['create', 'store']);
    
    // Course-Student Management (Admin assigning students to courses)
    Route::get('/course-students', [CourseStudentController::class, 'index'])
        ->middleware('checkAdminRole')
        ->name('course-students.index');
    
    Route::get('/course-students/{course}', [CourseStudentController::class, 'show'])
        ->middleware('checkAdminRole')
        ->name('course-students.show');
    
    Route::post('/course-students/{course}/assign/{student}', [CourseStudentController::class, 'assign'])
        ->middleware('checkAdminRole')
        ->name('course-students.assign');
    
    Route::delete('/course-students/{course}/unassign/{student}', [CourseStudentController::class, 'unassign'])
        ->middleware('checkAdminRole')
        ->name('course-students.unassign');
    
    Route::post('/course-students/{course}/bulk-assign', [CourseStudentController::class, 'bulkAssign'])
        ->middleware('checkAdminRole')
        ->name('course-students.bulkAssign');
    
    // Student view - manage courses per student
    Route::get('/course-students/students/list', [CourseStudentController::class, 'studentsList'])
        ->middleware('checkAdminRole')
        ->name('course-students.studentsList');
    
    Route::get('/course-students/students/{student}/assign', [CourseStudentController::class, 'assignCourses'])
        ->middleware('checkAdminRole')
        ->name('course-students.assignCourses');
    
    Route::post('/course-students/students/{student}/bulk-assign', [CourseStudentController::class, 'bulkAssignCourses'])
        ->middleware('checkAdminRole')
        ->name('course-students.bulkAssignCourses');
    
    Route::delete('/course-students/students/{student}/remove/{course}', [CourseStudentController::class, 'removeCourse'])
        ->middleware('checkAdminRole')
        ->name('course-students.removeCourse');
});



Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('generatePdf');
Route::get('/export-students', function (){
    return Excel::download(new StudentsExport, 'students.xlsx');
});
Route::get('/export-teachers', function (){
    return Excel::download(new TeachersExport, 'teachers.xlsx');
});
Route::get('/export-teachers-pdf', [PDFController::class, 'exportTeachersPDF'])->name('exportTeachersPDF');
Route::get('/export-students-pdf', [PDFController::class, 'exportStudentsPDF'])->name('exportStudentsPDF');

Route::get('/image-form', function() {
    return view ('upload');
});
Route::get('/upload-image', function() {
    return view('upload');
});
Route::post('/upload-image', [ImageController::class, 'upload'])->name('upload.image');


Route::get('/', [UserController::class, 'login'])->name('login');


Route::post('/', [UserController::class, 'login']);
Route::get('/change-password', [UserController::class, 'showChangePassword'])->name('user.show-change-password');
Route::post('/update-password', [UserController::class, 'updatePassword'])->name('user.update-password');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');


// Activity Log Routes
Route::get('/activity-log', [ActivityLogController::class, 'index']);
Route::get('/activity-log/refresh', [ActivityLogController::class, 'refresh']);
Route::delete('/activity-log/clear', [ActivityLogController::class, 'clear']);

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/
Route::get('/greetings', [ClientController::class, 'displayGreetings'])->name("greetings");
Route::get('/profile', [ClientController::class, 'clientProfile'])->name("profile");
Route::get('/aboutUs', [ClientController::class, 'clientAboutUs'])->name("aboutus");
Route::get('/client', [ClientController::class, 'index']);

/*
|--------------------------------------------------------------------------
| PSU Example Route
|--------------------------------------------------------------------------
*/
Route::get('/student/{name}/{course}', [PSUController::class, 'student'])->name('Student');
Route::get('/maintenance', [PagesController::class, 'maintenance'])->name('maintenance');
