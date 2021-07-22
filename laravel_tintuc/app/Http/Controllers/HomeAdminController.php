<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\PhanHoi;
use App\Models\TinTuc;
use App\Models\User;

class HomeAdminController extends Controller
{
    //
    public function getTrangChu(){
        $thangNow =  strtotime(now());

        //  ========= get phan hoi  theo tháng 
       $phanHoiAll = PhanHoi::get('created_at');
       //    nếu tháng bằng tháng hiện tại thì cộng 
       $soLuongPhanHoi = 0;
       $soLuongPhanHoiTheoNgay = 0;
       foreach ($phanHoiAll as $pha) {
           if($pha->created_at->format('m Y') == date('m Y',  $thangNow ))  $soLuongPhanHoi ++;
           if($pha->created_at->format('d m Y') == date('d m Y',  $thangNow ))  $soLuongPhanHoiTheoNgay ++;
       }

       //============= get comments
       $commentAll = Comment::get('created_at');
       //    nếu tháng bằng tháng hiện tại thì cộng 
       $soLuongComment = 0;
       $soLuongCommentTheoNgay = 0;
       foreach ($commentAll as $cma) {
           if($cma->created_at->format('m Y') == date('m Y',  $thangNow ))  $soLuongComment ++;
           if($cma->created_at->format('d m Y') == date('d m Y',  $thangNow ))  $soLuongCommentTheoNgay ++;
       }

       //============= get register 
       $dangkyAll = User::get('created_at');
       //    nếu tháng bằng tháng hiện tại thì cộng 
       $soLuongDangKy = 0;
       $soLuongDangKyTheoNgay = 0;
       foreach ($dangkyAll as $dka) {
           if($dka->created_at->format('m Y') == date('m Y',  $thangNow ))  $soLuongDangKy ++;
           if($dka->created_at->format('d m Y') == date('d m Y',  $thangNow ))  $soLuongDangKyTheoNgay ++;
       }

      // get view 
      $tinTucAll = TinTuc::get();
      //    nếu tháng bằng tháng hiện tại thì cộng 
      $soLuongLuotXem = 0;
      $soLuongLuotXemTheoNgay = 0;
      foreach ($tinTucAll as $tta) {
          if($tta->created_at->format('m Y') == date('m Y',  $thangNow ))  $soLuongLuotXem +=  $tta->SoLuotXem;
          if($tta->created_at->format('d m Y') == date('d m Y',  $thangNow ))  $soLuongLuotXemTheoNgay +=  $tta->SoLuotXem;
      }

        return view('admin.trangChu.trangChu' ,[
            'soLuongPhanHoi' => $soLuongPhanHoi ,
            'soLuongComment' => $soLuongComment ,
            'soLuongDangKy' => $soLuongDangKy ,
            'soLuongPhanHoiTheoNgay' => $soLuongPhanHoiTheoNgay ,
            'soLuongCommentTheoNgay' => $soLuongCommentTheoNgay ,
            'soLuongDangKyTheoNgay' => $soLuongDangKyTheoNgay ,
            'soLuongLuotXem' => $soLuongLuotXem ,
            'soLuongLuotXemTheoNgay' => $soLuongLuotXemTheoNgay ,

        ]);
    }
}
