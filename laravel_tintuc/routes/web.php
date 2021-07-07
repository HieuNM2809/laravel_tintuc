<?php
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

// middleware
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\HomeMiddleware;

// use controller
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\LoaiTinController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PagesController;

// use model
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\Comment;
use App\Models\User;
use App\Models\Slide;

// cache
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
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
// dang nhap admin
Route::get('admin/login',[UserController::class , 'getAdminLogin']);
Route::post('admin/login',[UserController::class , 'postAdminLogin']);

// dang xuat admin
Route::get('admin/logout',[UserController::class , 'getAdminLogout']);

// route admin
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
    Route::prefix('mail')->group(function () {
        // lay
        Route::get('them',[MailController::class , 'getThem']);
        //them
        Route::post('them',[MailController::class , 'postThem']);
    });

});

// route home
Route::middleware(['HomeShareMiddleware'])->prefix('')->group(function () {
    Route::get('trangchu', [PagesController::class , 'trangchu'] );
    Route::get('loaitin/{id}/{tenkhongdau}.html', [PagesController::class , 'loaitin'] );
    Route::get('tintuc/{id}/{tenkhongdau}.html', [PagesController::class , 'tintuc'] );
    Route::get('gioithieu', [PagesController::class , 'gioithieu'] );
    Route::get('lienhe', [PagesController::class , 'lienhe'] );
    Route::get('timkiem', [PagesController::class , 'timkiem'] );
    Route::get('comment/{idTinTuc}/{content}', [CommentController::class , 'them'] );

    //route  dang xuat
    Route::get('dangxuat', [PagesController::class , 'dangxuat'] );
    // nguoidung
    Route::get('nguoidung', [PagesController::class , 'getnguoidung'] );
    Route::post('nguoidung', [PagesController::class , 'postnguoidung'] );

    //phan hoi
    Route::get('phanhoi', [PagesController::class, 'phanhoi'])->middleware('HomeMiddleware');
});

//route dangky nguoi dung
Route::get('dangky', [PagesController::class , 'getdangky'] );
Route::post('dangky', [PagesController::class , 'postdangky'] );

// route dang nhap
Route::get('dangnhap', [PagesController::class , 'getdangnhap'] );
Route::post('dangnhap', [PagesController::class , 'postdangnhap'] );






Route::get('test', function () {
    $start = microtime(true);
    $tintuc = Cache::remember('tintuc', 60, function() {
        echo "dazo<br>";
        return TinTuc::all();
    });
    var_dump($tintuc);
    $end = number_format((microtime(true) - $start),2);
    echo "this page loaded in " . $end .'seconds';

    
});
Route::get('sendmail', function () {
    $ds =[
        'nmhieucoder@gmail.com',
        'nguyenminh@gmail.com'
    ];
    Mail::send('mail.thongbaotinmoi',['name'=>'hieu'], function ($message) use ($ds){
        $message->from('nguyenminhhieu28092001k3@gmail.com', 'Hieu Minh');
        $message->to($ds, 'HM');
        $message->subject('Test HM');

        // $message->attach( $req->file('txtFile')->getRealPath(), [
        //     'as' => $req->file('txtFile')->getClientOriginalName(),
        //     'mime' =>  $req->file('txtFile')->getMimeType()
        //  ]);
    });

});
Route::get('viewmail', function () {
    // return view('mail.thongbaotinmoi');
    echo now();
});


