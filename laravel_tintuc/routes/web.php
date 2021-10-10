<?php
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

// middleware
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\HomeMiddleware;
use App\Http\Middleware\RoleMiddleware;

// use controller
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\LoaiTinController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\HomeAdminController;

// use model
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\Comment;
use App\Models\User;
use App\Models\Slide;
use App\Models\ThongKe;

// cache
use Illuminate\Support\Facades\Cache;
use Symfony\Component\VarDumper\Cloner\Data;

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
Route::get('admin/login',[UserController::class , 'getAdminLogin'])->middleware('RedirectAdminLoginMiddleware');
Route::post('admin/login',[UserController::class , 'postAdminLogin'])->middleware('RedirectAdminLoginMiddleware');

// dang xuat admin
Route::get('admin/logout',[UserController::class , 'getAdminLogout']);

// route admin
Route::middleware(['AdminMiddleware'])->prefix('admin')->group(function () {
    Route::get('trangchu',[HomeAdminController::class , 'getTrangChu']);

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

        // ghim
        Route::prefix('ghim')->group(function () {
            // lay
            Route::get('them',[TinTucController::class , 'getGhim']);
            //them
            Route::post('them',[TinTucController::class , 'postGhim']);
        });
        Route::get('ajaxTinTuc/{val}',[TinTucController::class , 'ajaxTinTuc']);

        // duyet tin 
        Route::middleware(['RoleMiddleware'])->get('duyettintuc',[TinTucController::class , 'getDuyetTinTuc']);
        Route::middleware(['RoleMiddleware'])->get('duyettintuc/{id}',[TinTucController::class , 'postDuyetTinTuc']);
       
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
 
    Route::middleware(['RoleMiddleware'])->prefix('user')->group(function () {
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
    Route::get('phanhoi', [PagesController::class, 'getphanhoi'])->middleware('HomeMiddleware');
    Route::post('phanhoi', [PagesController::class, 'postphanhoi'])->middleware('HomeMiddleware');
});

//route dangky nguoi dung
Route::get('dangky', [PagesController::class , 'getdangky'] );
Route::post('dangky', [PagesController::class , 'postdangky'] );

// route dang nhap
Route::get('dangnhap', [PagesController::class , 'getdangnhap'] );
Route::post('dangnhap', [PagesController::class , 'postdangnhap'] );





// =============================================== test

Route::get('test', function () {
   echo env('APP_DOMAIN');
});

Route::get('viewSendMail', function () {
    return view('mail.thongBaoDangKyThanhCong');
}); 


Route::get('tryCatch', function () {
    try {
      echo 'hieu';
    } catch (\Throwable $th) {
        echo 'cacth';
    }
});
Route::get('log', function () {
    Log::channel('sendMailAll')->info('test ne 45');
     echo 'ok';
});
Route::get('thongketest', function () {
   $checkRecordDateExist = ThongKe::where('ngaythangnam', date('Y-m-d',strtotime(now())) )->count();
   $checkRecordMonthExist = ThongKe::whereYear('thangnam', date('Y',strtotime(now())) )
                                    ->whereMonth('thangnam', date('m',strtotime(now())) )   
                                    ->count();

});