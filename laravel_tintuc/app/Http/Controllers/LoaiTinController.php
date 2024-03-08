<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LoaiTinController extends Controller
{
      // get
    public function getDanhSach(){

        $loaitin = LoaiTin::where('Xoa',0)->get();
        return view('admin.loaitin.danhsach',
           ['loaitin'=> $loaitin]
        );
    }
    public function getThem(){
        return view('admin.loaitin.them', ['theloai'=> TheLoai::all()]);
    }
    public function getSua($id){
        return view('admin.loaitin.sua',
        ['theloai'=> TheLoai::all(),
        'loaitin'=> LoaiTin::find($id)]
    );
    }

    //edit
    public function postThem(Request $req){
        // Kiểm tra dữ liệu đầu vào
        $this->validate($req,
            [
                'Ten'=>'required|min:3|max:100|unique:LoaiTin,Ten'
            ],[
                'Ten.required' => 'Hãy nhập thông tin',
                'Ten.min'      => 'Hãy nhập ít nhất 3 ký tự và nhiều nhất 100 ký tự',
                'Ten.max'      => 'Hãy nhập ít nhất 3 ký tự và nhiều nhất 100 ký tự',
                'Ten.unique'   => 'Thể loại đã tồn tại',
            ]
        );
        // Thêm dữ liệu
        $loaitin = new LoaiTin();
        $loaitin->Ten = $req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->Ten);
        $loaitin->idTheLoai = $req->idTheLoai;
        $loaitin->save();

        //thông báo
         return redirect('admin/loaitin/them')->with('thongbao', 'Thêm thành công');
    }
    public function putSua(Request $req, $id){
        // Kiểm tra dữ liệu đầu vào
        $this->validate($req,
            [
                'Ten'=>'required|min:3|max:100|unique:theloai,Ten'
            ],[
                'Ten.required' => 'Hãy nhập thông tin',
                'Ten.min'      => 'Hãy nhập ít nhất 3 ký tự và nhiều nhất 100 ký tự',
                'Ten.max'      => 'Hãy nhập ít nhất 3 ký tự và nhiều nhất 100 ký tự',
                'Ten.unique'   => 'Thể loại đã được sử dụng',
            ]
        );
        // Thêm dữ liệu
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->Ten);
        $loaitin->idTheLoai = $req->idTheLoai;
        $loaitin->save();

        //thông báo
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao', 'Sửa thành công');
    }
    public function deleteXoa(Request $req, $id){
        $loaiTin = LoaiTin::find($id);
        $loaiTin->Xoa = 1;
        $loaiTin->save();
        return redirect('admin/loaitin/danhsach')->with('thongbao', 'Xóa thành công');
    }
}
