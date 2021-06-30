<?php
// middleware
use App\Http\Middleware\AdminMiddleware;
// use controller
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\LoaiTinController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SlideController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// use model
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\Comment;
use App\Models\User;
use App\Models\Slide;
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
Route::get('test', function () {
     print_r(Auth::user());
});
Route::get('test1', function () {
    // print_r(Auth::user());
    Auth::logout();
});
Route::get('admin/login',[UserController::class , 'getAdminLogin']);
Route::post('admin/login',[UserController::class , 'postAdminLogin']);
Route::get('admin/logout',[UserController::class , 'getAdminLogout']);

Route::middleware(['AdminMiddleware'])->prefix('admin')->group(function () {
    Route::prefix('theloai')->group(function () {
        // admin/theloai/danhsach
        Route::get('danhsach',[TheLoaiController::class , 'getDanhSach']);
        Route::get('them',[TheLoaiController::class , 'getThem']);
        Route::get('sua/{id}',[TheLoaiController::class , 'getSua']);

        //them
        Route::post('them',[TheLoaiController::class , 'postThem']);
        //sua
        Route::post('sua/{id}',[TheLoaiController::class , 'putSua']);
        //xoa
        Route::get('xoa/{id}',[TheLoaiController::class , 'deleteXoa']);

    });
    Route::prefix('loaitin')->group(function () {
        // lay
        Route::get('danhsach',[LoaiTinController::class , 'getDanhSach']);
        Route::get('them',[LoaiTinController::class , 'getThem']);
        Route::get('sua/{id}',[LoaiTinController::class , 'getSua']);

        //them
        Route::post('them',[LoaiTinController::class , 'postThem']);
        //sua
        Route::post('sua/{id}',[LoaiTinController::class , 'putSua']);
        //xoa
        Route::get('xoa/{id}',[LoaiTinController::class , 'deleteXoa']);
    });
    Route::prefix('tintuc')->group(function () {
        // lay
        Route::get('danhsach',[TinTucController::class , 'getDanhSach']);
        Route::get('them',[TinTucController::class , 'getThem']);
        Route::get('sua/{id}',[TinTucController::class , 'getSua']);

        //them
        Route::post('them',[TinTucController::class , 'postThem']);
        //sua
        Route::post('sua/{id}',[TinTucController::class , 'putSua']);
        //xoa
        Route::get('xoa/{id}',[TinTucController::class , 'deleteXoa']);

        // ajax
        Route::get('ajax/{id}',[TinTucController::class , 'ajaxLoaiTin']);
    });
    Route::prefix('comment')->group(function () {
        //xoa
        Route::get('xoa/{id}/{idTinTuc}',[CommentController::class , 'deleteXoa']);
    });
    Route::prefix('slide')->group(function () {
        // lay
        Route::get('danhsach',[SlideController::class , 'getDanhSach']);
        Route::get('them',[SlideController::class , 'getThem']);
        Route::get('sua/{id}',[SlideController::class , 'getSua']);

        //them
        Route::post('them',[SlideController::class , 'postThem']);
        //sua
        Route::post('sua/{id}',[SlideController::class , 'putSua']);
        //xoa
        Route::get('xoa/{id}',[SlideController::class , 'deleteXoa']);
    });
    Route::prefix('user')->group(function () {
        // lay
        Route::get('danhsach',[UserController::class , 'getDanhSach']);
        Route::get('them',[UserController::class , 'getThem']);
        Route::get('sua/{id}',[UserController::class , 'getSua']);

        //them
        Route::post('them',[UserController::class , 'postThem']);
        //sua
        Route::post('sua/{id}',[UserController::class , 'putSua']);
        //xoa
        Route::get('xoa/{id}',[UserController::class , 'deleteXoa']);
    });

});
