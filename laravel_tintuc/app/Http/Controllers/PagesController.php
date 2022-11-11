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
use App\Models\PhanHoi;
use Illuminate\Support\Facades\Auth;
use App\Rules\Captcha;

use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Cache;
use App\Models\ThongKe;

use App\Events\RegisteredEvent;

class PagesController extends Controller
{
    public function __construct()
    {
        $theLoai = Cache::store('redis')->remember('theLoaiAll', 600, function () {
            return TheLoai::where('Xoa',0 )->get();
        });
        $slide = Cache::store('redis')->remember('slideAll', 600, function () {
            return Slide::where('Xoa',0 )->get();
        });
        view()->share('theloai' ,  $theLoai );
        view()->share('slide' ,$slide);
    }

    //
    public function trangchu(){
        $ghimTin = TinTuc::where('ghimTin','ghim')->orderBy('updated_at','DESC')->first();
        return view('pages.trangchu', ['ghimTin' =>$ghimTin]);
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
            $thongKe->luotxemngay = 1;
            $thongKe->save();
        }else{
            // có dòng rồi
            $thongKe = ThongKe::where('ngaythangnam', date('Y-m-d',strtotime(now())) )->first();
            $thongKe->luotxemngay  += 1;
            $thongKe->save();
        }
        // nếu chưa có thì thêm mới  ( thêm ngày)
        if($checkRecordMonthExist == 0){
            $thongKe = new ThongKe();
            $thongKe->thangnam = date('Y-m-d');
            $thongKe->luotxemthang = 1;
            $thongKe->save();
        }else{
            // có dòng rồi
            $thongKe = ThongKe::whereYear('thangnam', date('Y',strtotime(now())) )
                                ->whereMonth('thangnam', date('m',strtotime(now())) )
                                ->first();
            $thongKe->luotxemthang  += 1;
            $thongKe->save();

        }

        // update views
        $upView =  TinTuc::find($id);
        $upView->SoLuotXem ++ ;
        $upView->save();

        // cache
        $tintuc = Cache::store('redis')->remember('tintuc'.$id, 600 , function () use ($id) {
            return TinTuc::find($id);
        });
        $tinnoibat = Cache::store('redis')->remember('tinnoibat'.$id, 600 , function () use ($id) {
          return TinTuc::where('NoiBat',1)->orderBy('created_at','DESC')->take(4)->get();
        });
        $tinlienquan = Cache::store('redis')->remember('tinlienquan'.$id, 600 , function () use ($id,$tintuc) {
            return TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->orderBy('created_at','DESC')->take(4)->get();
        });

        //view
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
            'passwordAgain'=>'required|same:password',
            'g-recaptcha-response' =>new Captcha()
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
            $thongKe->dangkyngay = 1;
            $thongKe->save();
        }else{
            // có dòng rồi
            $thongKe = ThongKe::where('ngaythangnam', date('Y-m-d',strtotime(now())) )->first();
            $thongKe->dangkyngay  += 1;
            $thongKe->save();
        }
        // nếu chưa có thì thêm mới  ( thêm ngày)
        if($checkRecordMonthExist == 0){
            $thongKe = new ThongKe();
            $thongKe->thangnam = date('Y-m-d');
            $thongKe->dangkythang = 1;
            $thongKe->save();
        }else{
            // có dòng rồi
            $thongKe = ThongKe::whereYear('thangnam', date('Y',strtotime(now())) )
                                ->whereMonth('thangnam', date('m',strtotime(now())) )
                                ->first();
            $thongKe->dangkythang  += 1;
            $thongKe->save();

        }
        // lưu thông tin
         $user = new  User();
         $user->name = $req->name;
         $user->email = $req->email;
         $user->role = 'user';
         $user->password = bcrypt($req->password);
         $user->save();

        // sự kiện gửi mail
        $pass = $req->password;
         event(new RegisteredEvent($user, $pass));

        //thong bao
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

    public function getphanhoi(){
        return view('pages.phanhoi');
    }
    public function postphanhoi(Request $req){
        $this->validate($req,[
            'txtPhanHoi' =>'required|min:12'
        ],[
            'txtPhanHoi.required' =>'Vui lòng nhập phản hồi',
            'txtPhanHoi.min'   =>'Vui lòng nhập ít nhất 12 ký tự'
        ]);
        $phanhoi =new PhanHoi();
        $phanhoi->idUser = Auth::user()->id;
        $phanhoi->NoiDung = $req->txtPhanHoi;
        $phanhoi->save();

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
            $thongKe->phanhoingay = 1;
            $thongKe->save();
        }else{
            // có dòng rồi
            $thongKe = ThongKe::where('ngaythangnam', date('Y-m-d',strtotime(now())) )->first();
            $thongKe->phanhoingay  += 1;
            $thongKe->save();
        }
        // nếu chưa có thì thêm mới  ( thêm ngày)
        if($checkRecordMonthExist == 0){
            $thongKe = new ThongKe();
            $thongKe->thangnam = date('Y-m-d');
            $thongKe->phanhoithang = 1;
            $thongKe->save();
        }else{
            // có dòng rồi
            $thongKe = ThongKe::whereYear('thangnam', date('Y',strtotime(now())) )
                                ->whereMonth('thangnam', date('m',strtotime(now())) )
                                ->first();
            $thongKe->phanhoithang  += 1;
            $thongKe->save();

        }


        return redirect('phanhoi')->with('thongbao', 'Gửi thành công, cảm ơn bạn đã phản hồi !!');
    }


}
