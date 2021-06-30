<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use Illuminate\Support\Facades\Auth;

class TheLoaiController extends Controller
{

    // get
    public function getDanhSach(){

        return view('admin.theloai.danhsach',
          ['theloai'=>TheLoai::all()]
        );
    }
    public function getThem(){
        return view('admin.theloai.them');
    }
    public function getSua($id){
        return view('admin.theloai.sua',['theloai'=> TheLoai::find($id)]);
    }

    //edit
    public function postThem(Request $req){
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
        $theloai = new TheLoai();
        $theloai->Ten = $req->Ten;
        $theloai->TenKhongDau = changeTitle($req->Ten);
        $theloai->save();

        //thông báo
        return redirect('admin/theloai/them')->with('thongbao', 'Thêm thành công');
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
        $theloai = TheLoai::find($id);
        $theloai->Ten = $req->Ten;
        $theloai->TenKhongDau = changeTitle($req->Ten);
        $theloai->save();

        //thông báo
        return redirect('admin/theloai/sua/'.$id)->with('thongbao', 'Sửa thành công');
    }
    public function deleteXoa(Request $req, $id){
        TheLoai::find($id)->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao', 'Xóa thành công');
    }
}
