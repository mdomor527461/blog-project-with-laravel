<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Frontend\CatBlogController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\GuestAuthentication;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Auth::routes(['register' => false]);
//frontend controller
Route::get('/', [FrontendHomeController::class, 'index'])->name('root');
Route::get('/about', [FrontendHomeController::class, 'about'])->name('about');
Route::get('/contact', [FrontendHomeController::class, 'contact'])->name('contact');
Route::post('contact/mail',[MailController::class, 'sendMail'])->name('send_mail');
Route::get('/category/{slug}',[CatBlogController::class,'show'])->name('frontend.cat.blog');
Route::get('/frontend/blogs',[FrontendBlogController::class,'index'])->name('frontend.blog');
Route::get('/frontend/blog/single/{id}',[FrontendBlogController::class,'single_blog'])->name('blog.single');
Route::post('/frontend/blog/single/comment/{id}',[FrontendBlogController::class,'comment'])->name('comment');


Route::middleware(['auth','verified'])->group(function(){

    //home routes
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/management/user/register', [ManagementController::class, 'store_register'])->name('management.store');
    Route::post('/management/user/manager/down/{id}', [ManagementController::class, 'manager_down'])->name('management.down');
    //profile routes
Route::get('/home/profile',[ProfileController::class , 'index'])->name('home.profile');
Route::post('/home/profile/name/update',[ProfileController::class , 'name_update'])->name('home.profile.name.update');
Route::post('/home/profile/email/update',[ProfileController::class , 'email_update'])->name('home.profile.email.update');
Route::post('/home/profile/password/update',[ProfileController::class , 'password_update'])->name('home.profile.password.update');
Route::post('/home/profile/image/update',[ProfileController::class , 'image_update'])->name('home.profile.image.update');
//category routes
Route::get('category',[CategoryController::class, 'index'])->name('category.index');
Route::post('category/store',[CategoryController::class, 'store'])->name('category.store');
Route::get('category/edit/{slug}',[CategoryController::class, 'edit'])->name('category.edit');
Route::post('category/update/{slug}',[CategoryController::class, 'update'])->name('category.update');
Route::get('category/delete/{slug}',[CategoryController::class, 'delete'])->name('category.delete');
Route::post('/category/status/{slug}',[CategoryController::class,'status'])->name('category.status');
//management
Route::prefix(env('HOST_NAME'))->middleware('rolecheck')->group(function(){
    Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
    Route::post('/management/user/register', [ManagementController::class, 'store_register'])->name('management.store');
    Route::post('/management/user/manager/down/{id}', [ManagementController::class, 'manager_down'])->name('management.down');
    Route::get('/management/manager/delete/{id}', [ManagementController::class, 'manager_delete'])->name('manager.delete');
    //role
    Route::get('/management/role',[ManagementController::class, 'role_index'])->name('role.index');
    Route::post('/management/role/assign', [ManagementController::class, 'role_assign'])->name('management.role.assign');
    Route::post('/management/role/undo/blogger/{id}', [ManagementController::class, 'blogger_grade_down'])->name('management.role.blogger.down');
    Route::post('/management/role/undo/user/{id}', [ManagementController::class, 'user_grade_down'])->name('management.role.user.down');
    Route::post('/management/role/unblock/user/{id}', [ManagementController::class, 'user_grade_up'])->name('management.role.user.up');
    Route::get('/management/blogger/delete/{id}', [ManagementController::class, 'blogger_delete'])->name('management.blogger.delete');
    Route::get('/management/user/delete/{id}', [ManagementController::class, 'user_delete'])->name('management.user.delete');

});
    //blog route
    Route::resource('/blog',BlogController::class);
    Route::post('/blog/status/{slug}',[BlogController::class,'status'])->name('blog.status.update');
});
//frontend auth
Route::get('guest/register',[GuestAuthentication::class,'register'])->name('guest.register');
Route::post('guest/register',[GuestAuthentication::class,'register_post'])->name('guest.register');
Route::get('guest/login',[GuestAuthentication::class,'login'])->name('guest.login');
Route::post('guest/login',[GuestAuthentication::class,'login_post'])->name('guest.login');

//mail verification
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
