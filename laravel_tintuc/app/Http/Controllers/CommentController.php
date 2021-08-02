<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\ThongKe;
class CommentController extends Controller
{
    //
    public function deleteXoa($id,$idTinTuc){
        Comment::find($id)->delete();
        //thong bao
        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbaoCom','Xóa thành công');
    }
    public function them($idTinTuc, $content){
        if($content ==""){
            return;
        }

        //==================================lưu vào bảng thống kê 
        //kiểm tra xem có dòng đó chưa
        $checkRecordDateExist = ThongKe::where('ngaythangnam', date('Y-m-d',strtotime(now())) )->count();
        $checkRecordMonthExist = ThongKe::whereYear('thangnam', date('Y',strtotime(now())) )
                                         ->whereMonth('thangnam', date('m',strtotime(now())) )   
                                         ->count();
        
        // nếu chưa có thì thêm mới  ( thêm ngày)
        if($checkRecordDateExist == 0){
            $thongKe = new ThongKe();
            $thongKe->ngaythangnam = date('Y-m-d');
            $thongKe->commentngay = 1;
            $thongKe->save();
        }else{
            // có dòng rồi 
            $thongKe = ThongKe::where('ngaythangnam', date('Y-m-d',strtotime(now())) )->first();
            $thongKe->commentngay  += 1;
            $thongKe->save();
        }     
        // nếu chưa có thì thêm mới  ( thêm ngày)
        if($checkRecordMonthExist == 0){
            $thongKe = new ThongKe();
            $thongKe->thangnam = date('Y-m-d');
            $thongKe->commentthang = 1;
            $thongKe->save();
        }else{
            // có dòng rồi 
            $thongKe = ThongKe::whereYear('thangnam', date('Y',strtotime(now())) )
                                ->whereMonth('thangnam', date('m',strtotime(now())) )
                                ->first();
            $thongKe->commentthang  += 1;
            $thongKe->save();

        }      




        $com = new Comment();
        $com->idUser = Auth::user()->id;
        $com->idTinTuc = $idTinTuc;
        $com->NoiDung = $content;
        $com->save();

        $conAll = Comment::where('idTinTuc',$idTinTuc)->orderBy('created_at', 'DESC')->get();
        foreach ($conAll as  $ca) {
            echo  '<div class="media">';
            echo  '<a class="pull-left" >';
            echo  '<img class="media-object" src="http://placehold.it/64x64">';
            echo  '</a>';
            echo  '<div class="media-body">';
            echo  '<h4 class="media-heading"  style="font-weight: 600;">';
            echo   $ca->user->name;
            echo   '<small> Ngày '.$ca->created_at .'giờ</small>';
            echo '</h4>';
            echo  $ca->NoiDung;
            echo '</div>';
            echo '</div>';
        }
    }
}
