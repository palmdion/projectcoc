<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


use App\Http\Controllers\UserController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\Auth\RegisterController;




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
    return view('welcome')->name('welcome');
});


Route::get('/management-admin', function () {
    return view('admin.index');
});

Route::get('/mainPost', function () {
    return view('post.posts');
});
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/404', function () {
    return view('test');
});

Route::post('/register', 'Auth\RegisterController@register')->name('register');

// Event Page
Route::prefix('eventHome')->name('eventHome.')->group(function(){
    Route::get('/EventDetail/{id}', [HomeController::class, 'showEvent'])->name('showEvent');
    Route::get('/mainEvent', [HomeController::class, 'showAllEvent'])->name('showAllEvent');
    Route::get('/eventAdd', [HomeController::class, 'eventAdd'])->name('eventAdd');
    Route::post('/storeEvent', [HomeController::class, 'storeEvent'])->name('storeEvent');

    Route::post('/joinEventH', [CalendarController::class, 'joinEventH'])->name('joinEventH');
});

// Post Page
Route::prefix('postHome')->name('postHome.')->group(function(){
    Route::get('/PostDetail/{id}', [HomeController::class, 'showPost'])->name('showPost');
    Route::get('/mainPost', [HomeController::class, 'showAllPost'])->name('showAllPost');
    Route::get('/postAdd', [HomeController::class, 'postAdd'])->name('postAdd');
    Route::post('/storePost', [HomeController::class, 'storePost'])->name('storePost');
});
// recognition Page
Route::prefix('recognition')->name('recognition.')->group(function(){
    Route::get('/userDetail/{id}', [HomeController::class, 'showUser'])->name('showUser');
    Route::get('/mainUser', [HomeController::class, 'showAllUser'])->name('showAllUser');
});


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'indexHome'])->name('home');

// Profile
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [UserController::class, 'getProfile'])->name('detail');
    Route::get('/profileFace', [UserController::class, 'profileFace'])->name('profileFace');

    Route::post('/verify-alumni', [AlumniController::class, 'verifyAlumni'])->name('verifyAlumni');
    Route::post('/add-education', [AlumniController::class, 'addEducation'])->name('addEducation');
    Route::post('/add-work', [AlumniController::class, 'addWork'])->name('addWork');

    Route::delete('/deleteEdu/{id}', [AlumniController::class, 'deleteEdu'])->name('deleteEdu');
    Route::get('/editEdu/{id}', [AlumniController::class, 'editEdu'])->name('editEdu');
    Route::put('/updateEdu/{edu}', [AlumniController::class, 'updateEdu'])->name('updateEdu');

    Route::delete('/deleteWork/{id}', [AlumniController::class, 'deleteWork'])->name('deleteWork');
    Route::get('/editWork/{id}', [AlumniController::class, 'editWork'])->name('editWork');
    Route::put('/updateWork/{Work}', [AlumniController::class, 'updateWork'])->name('updateWork');

    Route::get('/manageProfile', [UserController::class, 'manageProfile'])->name('manageProfile');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
    Route::post('/updateProfile', [UserController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/myPosts', [UserController::class, 'myPosts'])->name('myPosts');
    Route::get('/editPost{id}', [UserController::class, 'editPost'])->name('editPost');
    Route::put('/updatePost/{id}', [UserController::class, 'updatePost'])->name('updatePost');
    Route::delete('/deletePost/{id}', [UserController::class, 'deletePost'])->name('deletePost');
    Route::get('/myEvent', [UserController::class, 'myEvent'])->name('myEvent');
    Route::get('/editEvent/{id}', [UserController::class, 'editEvent'])->name('editEvent');
    Route::put('/updateEvent/{id}', [UserController::class, 'updateEvent'])->name('updateEvent');
    Route::delete('/deleteEvent/{id}', [UserController::class, 'deleteEvent'])->name('deleteEvent');
});

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

// Users
Route::middleware('auth')->prefix('user')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('destroy');

    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');

    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');
    Route::get('export/', [UserController::class, 'export'])->name('export');

    Route::get('/import-alumni', [AlumniController::class, 'importAlumni'])->name('importAlumni');
    Route::post('/upload-alumni', [AlumniController::class, 'uploadAlumni'])->name('uploadAlumni');
});



//Education
Route::middleware('auth')->prefix('education')->name('education.')->group(function(){
    Route::get('/', [EducationController::class, 'index'])->name('index');
    Route::get('/create', [EducationController::class, 'create'])->name('create');
    Route::post('/store', [EducationController::class, 'store'])->name('store');
});

//Work
Route::middleware('auth')->prefix('work')->name('work.')->group(function(){
    Route::get('/', [WorkController::class, 'index'])->name('index');
});

//Posts
Route::middleware('auth')->prefix('posts')->name('posts.')->group(function(){
    Route::get('/indexPost', [PostController::class, 'indexPost'])->name('indexPost');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [PostController::class, 'update'])->name('update');
    Route::get('/show/{id}', [PostController::class, 'show'])->name('show');
    Route::delete('/delete/{id}', [PostController::class, 'delete'])->name('delete');

    //Route::get('/update/status/{post_id}/{status}', [PostController::class, 'updateStatus'])->name('status');
});

//Category
Route::middleware('auth')->prefix('category')->name('category.')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
});

//Tags
Route::middleware('auth')->prefix('tag')->name('tag.')->group(function(){
    Route::get('/', [TagController::class, 'index'])->name('index');
    Route::get('/create', [TagController::class, 'create'])->name('create');
    Route::post('/store', [TagController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TagController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [TagController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [TagController::class, 'delete'])->name('delete');
});



//Events
Route::middleware('auth')->prefix('event')->name('event.')->group(function(){
    Route::get('/index', [CalendarController::class, 'index'])->name('index');
    Route::get('/create', [CalendarController::class, 'create'])->name('create');
    Route::post('/storeEvent', [CalendarController::class, 'storeE'])->name('store');
    Route::post('/joinEvent', [CalendarController::class, 'joinEvent'])->name('joinEvent');
    Route::get('/edit/{id}', [CalendarController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [CalendarController::class, 'update'])->name('update');
    Route::get('/show/{id}', [CalendarController::class, 'show'])->name('show');
    Route::delete('/delete/{id}', [CalendarController::class, 'delete'])->name('delete');

    Route::post('/joinEvent', [CalendarController::class, 'joinEvent'])->name('joinEvent');
});

//Send Mail
Route::middleware('auth')->prefix('mail')->name('mail.')->group(function(){
    Route::get('/', [ShipmentController::class, 'index'])->name('indexSendMail');
    Route::post('/send', [ShipmentController::class, 'send'])->name('sendMail');
});


