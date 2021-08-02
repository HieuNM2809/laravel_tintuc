<?php

namespace App\Http\Controllers;

use App\Models\ThongKe;

class HomeAdminController extends Controller
{
    //
    public function getTrangChu(){
        $checkRecordDataExist = ThongKe::where('ngaythangnam', date('Y-m-d',strtotime(now())) )->count();
        $checkRecordMonthExist = ThongKe::whereYear('thangnam', date('Y',strtotime(now())) )
                                         ->whereMonth('thangnam', date('m',strtotime(now())) )   
                                         ->count();
        
        // nếu chưa có thì thêm mới  ( thêm ngày)
        if($checkRecordDataExist == 0){
            $thongKe = new ThongKe();
            $thongKe->ngaythangnam = date('Y-m-d');
            $thongKe->save();
        }
        // nếu chưa có thì thêm mới  ( thêm thang)
        if($checkRecordMonthExist == 0){
            $thongKe = new ThongKe();
            $thongKe->thangnam = date('Y-m-d');
            $thongKe->save();
        }   
        $thongKeTheoNgay = ThongKe::where('ngaythangnam', date('Y-m-d',strtotime(now())) )->first();
        $thongKeTheoThang = ThongKe::whereYear('thangnam', date('Y',strtotime(now())) )
                                ->whereMonth('thangnam', date('m',strtotime(now())) )
                                ->first();

        return view('admin.trangChu.trangChu' ,[
            'soLuongPhanHoi' => $thongKeTheoThang->phanhoithang ,
            'soLuongComment' => $thongKeTheoThang->commentthang ,
            'soLuongDangKy' => $thongKeTheoThang->dangkythang ,
            'soLuongLuotXem' => $thongKeTheoThang->luotxemthang ,
            'soLuongPhanHoiTheoNgay' => $thongKeTheoNgay->phanhoingay ,
            'soLuongCommentTheoNgay' => $thongKeTheoNgay->commentngay ,
            'soLuongDangKyTheoNgay' => $thongKeTheoNgay->dangkyngay ,
            'soLuongLuotXemTheoNgay' => $thongKeTheoNgay->luotxemngay ,

        ]);
    }
}



// ======================================== code đến trong bảng và cộng created_at lại 
   //    $thangNow =  strtotime(now());

    //     //  ========= get phan hoi  theo tháng 
    //    $phanHoiAll = PhanHoi::get('created_at');
    //    //    nếu tháng bằng tháng hiện tại thì cộng 
    //    $soLuongPhanHoi = 0;
    //    $soLuongPhanHoiTheoNgay = 0;
    //    foreach ($phanHoiAll as $pha) {
    //        if($pha->created_at->format('m Y') == date('m Y',  $thangNow ))  $soLuongPhanHoi ++;
    //        if($pha->created_at->format('d m Y') == date('d m Y',  $thangNow ))  $soLuongPhanHoiTheoNgay ++;
    //    }

    //    //============= get comments
    //    $commentAll = Comment::get('created_at');
    //    //    nếu tháng bằng tháng hiện tại thì cộng 
    //    $soLuongComment = 0;
    //    $soLuongCommentTheoNgay = 0;
    //    foreach ($commentAll as $cma) {
    //        if($cma->created_at->format('m Y') == date('m Y',  $thangNow ))  $soLuongComment ++;
    //        if($cma->created_at->format('d m Y') == date('d m Y',  $thangNow ))  $soLuongCommentTheoNgay ++;
    //    }

    //    //============= get register 
    //    $dangkyAll = User::get('created_at');
    //    //    nếu tháng bằng tháng hiện tại thì cộng 
    //    $soLuongDangKy = 0;
    //    $soLuongDangKyTheoNgay = 0;
    //    foreach ($dangkyAll as $dka) {
    //        if($dka->created_at->format('m Y') == date('m Y',  $thangNow ))  $soLuongDangKy ++;
    //        if($dka->created_at->format('d m Y') == date('d m Y',  $thangNow ))  $soLuongDangKyTheoNgay ++;
    //    }

    //   // get view 
    //   $tinTucAll = TinTuc::get();
    //   //    nếu tháng bằng tháng hiện tại thì cộng 
    //   $soLuongLuotXem = 0;
    //   $soLuongLuotXemTheoNgay = 0;
    //   foreach ($tinTucAll as $tta) {
    //       if($tta->created_at->format('m Y') == date('m Y',  $thangNow ))  $soLuongLuotXem +=  $tta->SoLuotXem;
    //       if($tta->created_at->format('d m Y') == date('d m Y',  $thangNow ))  $soLuongLuotXemTheoNgay +=  $tta->SoLuotXem;
    //   }