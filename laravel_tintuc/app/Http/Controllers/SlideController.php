<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Facades\Cache;

class SlideController extends Controller
{
     // get
    public function getDanhSach(){

        $slide = Slide::where('Xoa',0)->get();
        return view('admin.slide.danhsach',
             ['slide'=> $slide]
        );
    }
    public function getThem(){
        return view('admin.slide.them');
    }
    public function getSua($id){
        return view('admin.slide.sua',['slide'=>Slide::find($id)]);
    }

    //edit
    public function postThem(Request $req){
        //kiem tra
        // kiem tra du lieu dau vao
        $this->validate($req,
        [
            'Ten' => 'required',
            'NoiDung'   => 'required',
            'link'   => 'required',
            'Hinh'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4086',
        ],[
            'Ten.required'    =>'Bạn chưa nhập tên',
            'NoiDung.required'   =>'Bạn chưa nhập nội dung',
            'link.required'   =>'Bạn chưa nhập link',
            'Hinh.image'         =>'Vui lòng chọn hình ảnh',
            'Hinh.required'       =>'Bạn chưa chọn hình',
            'Hinh.mimes'         =>'Vui lòng chọn định dạng jpeg,png,jpg,gif,svg',
            'Hinh.max'           =>'Dung lượng tối đa là 4096 kilobytes'
         ]);
        //luu
        $slide = new Slide();
        $slide->Ten = $req->Ten;
        $slide->NoiDung = $req->NoiDung;
        $slide->link = $req->link;

       //them hinh
            // lay bien hinh
            $file = $req->file('Hinh');
            //lay ten
            $name = $file->getClientOriginalName();
            //tao tên không trùng (ghep vs ngay)
            $nameKhongTrung =  date('Y_m_d_H_i_s_').$name;
            $file->move('upload/slide', $nameKhongTrung);
            $slide->Hinh = $nameKhongTrung;

            $slide->save();
        //thong bao
        return redirect('admin/slide/them')->with('thongbao','Thêm thành công');

    }
    public function putSua(Request $req, $id){
         //kiem tra
        // kiem tra du lieu dau vao
        $this->validate($req,
        [
            'Ten' => 'required',
            'NoiDung'   => 'required',
        ],[
            'Ten.required'    =>'Bạn chưa nhập tên',
            'NoiDung.required'   =>'Bạn chưa nhập nội dung'
         ]);
        //luu
        $slide = Slide::find($id);
        $slide->Ten = $req->Ten;
        $slide->NoiDung = $req->NoiDung;
        if($req->has('link')){
          $slide->link = $req->link;
        }
       //them hinh
        if($req->hasFile('Hinh')){
            // lay bien hinh
            $file = $req->file('Hinh');
            //lay ten
            $name = $file->getClientOriginalName();
            //tao tên không trùng (ghep vs ngay)
            $nameKhongTrung =  date('Y_m_d_H_i_s_').$name;
            $file->move('upload/slide', $nameKhongTrung);
            unlink('upload/slide/'.$slide->Hinh);
            $slide->Hinh = $nameKhongTrung;
        }

          $slide->save();
        //thong bao
        return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa thành công');
    }
    public function deleteXoa( $id){
        $slide =  Slide::find($id);
        $slide->Xoa = 1;
        $slide->save();
        return redirect('admin/slide/danhsach')->with('thongbao','Xóa thành công');

    }
}
