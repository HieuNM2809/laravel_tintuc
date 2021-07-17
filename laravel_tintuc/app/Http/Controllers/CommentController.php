<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
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
