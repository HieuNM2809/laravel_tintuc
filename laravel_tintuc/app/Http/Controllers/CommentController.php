<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
class CommentController extends Controller
{
    //
    public function deleteXoa($id,$idTinTuc){
        Comment::find($id)->delete();
        //thong bao
        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbaoCom','Xóa thành công');
    }
}
