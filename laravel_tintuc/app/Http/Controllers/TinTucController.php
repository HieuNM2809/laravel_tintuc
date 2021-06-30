<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use Illuminate\Support\Facades\Auth;

class TinTucController extends Controller
{

    //get
    public function getDanhSach(){
        $tintuc = TinTuc::all();
        return view('admin.tintuc.danhsach', ['tintuc'=> $tintuc]);
    }
    public function getThem(){
        return view('admin.tintuc.them',[
            'theloai'=> TheLoai::all(),
            'loaitin'=> LoaiTin::where('idTheLoai','1')->get()
        ]);
    }
    public function getSua($id){
        return view('admin.tintuc.sua', [
            'tintuc'=>TinTuc::find($id),
            'loaitin'=> LoaiTin::all(),
            'theloai'=> TheLoai::all(),
        ]);
    }

    //edit
    public function postThem(Request $req){
        // kiem tra du lieu dau vao
        $this->validate($req,
        [
            'idLoaiTin' => 'required',
            'TieuDe'    => 'required|min:3|unique:tintuc,TieuDe',
            'TomTat'    => 'required',
            'NoiDung'   => 'required',
            'Hinh'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:4086',
        ],[
            'idLoaiTin.required' =>'Bạn chưa chọn loại tin',
            'TieuDe.required'    =>'Bạn chưa nhập tiêu đề',
            'TieuDe.min'         =>'Tiêu đề ít nhất 3 ký tự',
            'TieuDe.unique'      =>'Tiêu đề đã được sử dụng',
            'TomTat.required'    =>'Bạn chưa nhập tóm tắt',
            'NoiDung.required'   =>'Bạn chưa nhập nội dung',
            'Hinh.image'         =>'Vui lòng chọn hình ảnh',
            'Hinh.mimes'         =>'Vui lòng chọn định dạng jpeg,png,jpg,gif,svg',
            'Hinh.max'           =>'Dung lượng tối đa là 4096 kilobytes'
         ]);

        //them
         $tintuc = new TinTuc();
         $tintuc->TieuDe         = $req->TieuDe;
         $tintuc->TieuDeKhongDau = changeTitle($req->TieuDe);
         $tintuc->idLoaiTin      = $req->idLoaiTin;
         $tintuc->TomTat         = $req->TomTat;
         $tintuc->NoiDung        = $req->NoiDung;
         $tintuc->NoiBat         = $req->NoiBat;
         $tintuc->SoLuotXem      = 0;

        //them hinh
         if($req->hasFile('Hinh')){
             // lay bien hinh
             $file = $req->file('Hinh');
             //lay ten
             $name = $file->getClientOriginalName();
             //tao tên không trùng (ghep vs ngay)
             $nameKhongTrung =  date('Y_m_d_H_i_s_').$name;
             $file->move('upload/tintuc', $nameKhongTrung);
             $tintuc->Hinh = $nameKhongTrung;

         }else{
             $tintuc->Hinh = "";
         }

         $tintuc->save();

        //thong bao
        return redirect('admin/tintuc/them')->with('thongbao', 'Thêm thành công');
    }
    public function putSua(Request $req, $id){
         // kiem tra du lieu dau vao
         $this->validate($req,
         [
             'idLoaiTin' => 'required',
             'TieuDe'    => 'required|min:3',
             'TomTat'    => 'required',
             'NoiDung'   => 'required',
             'Hinh'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:4086',
         ],[
             'idLoaiTin.required' =>'Bạn chưa chọn loại tin',
             'TieuDe.required'    =>'Bạn chưa nhập tiêu đề',
             'TieuDe.min'         =>'Tiêu đề ít nhất 3 ký tự',
             'TomTat.required'    =>'Bạn chưa nhập tóm tắt',
             'NoiDung.required'   =>'Bạn chưa nhập nội dung',
             'Hinh.image'         =>'Vui lòng chọn hình ảnh',
             'Hinh.mimes'         =>'Vui lòng chọn định dạng jpeg,png,jpg,gif,svg',
             'Hinh.max'           =>'Dung lượng tối đa là 4096 kilobytes'
          ]);

         //them
          $tintuc = TinTuc::find($id);
          $tintuc->TieuDe         = $req->TieuDe;
          $tintuc->TieuDeKhongDau = changeTitle($req->TieuDe);
          $tintuc->idLoaiTin      = $req->idLoaiTin;
          $tintuc->TomTat         = $req->TomTat;
          $tintuc->NoiDung        = $req->NoiDung;
          $tintuc->NoiBat         = $req->NoiBat;

         //sua hinh
          if($req->hasFile('Hinh')){
              // lay bien hinh
              $file = $req->file('Hinh');
              //lay ten
              $name = $file->getClientOriginalName();
              //tao tên không trùng (ghep vs ngay)
              $nameKhongTrung =  date('Y_m_d_H_i_s_').$name;
              $file->move('upload/tintuc', $nameKhongTrung);
              // xoa file cu
              unlink("upload/tintuc/$tintuc->Hinh");
              $tintuc->Hinh = $nameKhongTrung;

          }

          $tintuc->save();

         //thong bao
          return redirect('admin/tintuc/sua/'.$id)->with('thongbao', 'Sửa thành công');

    }
    public function deleteXoa( $id){
        TinTuc::find($id)->delete();
        //thong bao
        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Xóa thành công');
    }

    public function ajaxLoaiTin($id){
        $loaitin = LoaiTin::where('idTheLoai',$id)->get();
        foreach ($loaitin as $lt )
           echo  "<option value='".$lt->id."'>".$lt->Ten."</option>";
    }
}
