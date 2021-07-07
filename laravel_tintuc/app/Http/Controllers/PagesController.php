<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Cache;

class PagesController extends Controller
{
    public function __construct()
    {
        view()->share('theloai' ,TheLoai::all());
        view()->share('slide' ,Slide::all());
    }

    //
    public function trangchu(){
        return view('pages.trangchu');
    }
    public function loaitin($id){
         $loaitin =  LoaiTin::find($id);
         $tintuc = TinTuc::where('idLoaiTin','=',$id)->paginate(5);
        return view('pages.loaitin',[
            'loaitin'=>$loaitin,
            'tintuc'=>$tintuc]
        );
    }
    public function tintuc($id){
       
        $tintuc =TinTuc::find($id);
        $tinnoibat =TinTuc::where('NoiBat',1)->orderBy('created_at','DESC')->take(4)->get();
        $tinlienquan =TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->orderBy('created_at','DESC')->take(4)->get();
        return view('pages.tintuc',[
            'tintuc'      => $tintuc, 
            'tinnoibat'   =>$tinnoibat ,
            'tinlienquan' => $tinlienquan
            ]);
    }
    public function gioithieu(){
        return view('pages.gioithieu');
    }
    public function lienhe(){
        return view('pages.lienhe');
    }   
    public function timkiem(Request $req){
        $this->validate($req, [
                'key' => 'required'
            ]);
        $key = $req->input('key');
        $tintuc =  TinTuc::where('TieuDe', 'like', "%$key%")
                                ->orWhere('TomTat', 'like', "%$key%")
                                ->orWhere('NoiDung', 'like', "%$key%")
                                ->orderBy('created_at','DESC')
                                ->paginate(5);
        $tintuc->appends(['key' => $key]);                        
        return view('pages.timkiem',['tintuc'=>$tintuc, 'key'=>$key]);
        
    }


    public function getdangky(){
        return view('pages.dangky');
    }
    public function postdangky(Request $req){
        $this->validate($req, [
            'name' => 'required|min:2|max:32',
            'email' => 'email|required|unique:users,email',
            'password' =>'required|min:6|max:32',
            'passwordAgain'=>'required|same:password'
        ], [
            'name.required' =>'Vui lòng nhập tên',
            'name.min'   => 'Tên tối thiểu 2 kí tự và nhiều nhất 32 kí tự',
            'name.max'   => 'Tên tối thiểu 2 kí tự và nhiều nhất 32 kí tự',
            'email.required'   =>'Vui lòng nhập email',
            'email.email'    =>'Sai định dạng email',
            'email.unique'    =>'email đã được sử dụng',
            'password.required' =>'Vui lòng nhập password',
            'password.min' =>'Password tối thiểu 2 kí tự và nhiều nhất 32 kí tự',
            'password.max' =>'Password tối thiểu 2 kí tự và nhiều nhất 32 kí tự',
            'passwordAgain.required' =>'Vui lòng nhập xác nhận password',
            'passwordAgain.same' =>'Nhập lại password sai'
        ]); 

         $user = new  User();
         $user->name = $req->name;
         $user->email = $req->email;
         $user->role = 0;
         $user->password = bcrypt($req->password);
         $user->save();

         return redirect('dangky')->with('thongbao','Tạo tài khoản thành công !!');
    }


    public function getdangnhap(){
        return view('pages.dangnhap');
    }
    public function postdangnhap( Request $req){
       $this->validate($req, [
            'email' =>'required|email',
            'password'=>'required'
       ] , [
            'email.required' =>'Vui lòng nhập email',
            'email.email' =>'Vui lòng nhập đúng định dạng email',
            'password.required' =>'Vui lòng nhập nhập khẩu'
       ]);

       if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
            return redirect('trangchu');
        }   
        return redirect('dangnhap')->with('thongbao', 'Đăng nhập thất bại');
    }

    public function dangxuat(){
        Auth::logout();
        return redirect('trangchu');
    }

    public function getnguoidung(){
         $nguoidung = Auth::user();
         return view('pages.nguoidung', ['nguoidung' =>$nguoidung]);
    }
    public function postnguoidung(Request $req){
        $this->validate($req,[
            'name' =>'required|min:3'
         ],[
            'name.required' =>'Vui lòng nhập tên',
            'name.min'      =>'Vui lòng nhập tên ít nhất 3 ký tự'
         ]);

         $user = Auth::user();
         $user->name = $req->name;
         if(isset($req->changePassword)){

            $this->validate($req,[
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'
             ],[
                'password.required' =>'Vui lòng nhập mật khẩu',
                'password.min'  =>'Vui lòng nhập mật khẩu ít nhất 3 ký tự',
                'password.max'   =>'Vui lòng nhập mật khẩu không quá 32 ký tự',
                'passwordAgain.required'   =>'Vui lòng nhập lại mật khẩu',
                'passwordAgain.same'       =>'Nhập lại Password không đúng'
             ]);
            $user->password = bcrypt($req->password);
         }
         $user->save();
         // thong bao
         return redirect('nguoidung')->with('thongbao','Sửa thành công');
    }




    public function phanhoi(){
        echo "da zo phan hoi";
    }



}
