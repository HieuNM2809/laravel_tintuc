<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    // dang nhap
    public function getAdminLogin(){
        return view('admin.login.login');
    }
    public function postAdminLogin(Request $req){
        $this->validate($req,[
            'email' => 'required|email',
            'password' =>'required'
        ],[
            'email.required' =>'Vui lòng nhập email',
            'email.email'   =>'Vui lòng nhập đúng cú pháp email',
            'password.required' =>'Vui lòng nhập mật khẩu'
        ] );
       if(Auth::attempt(['email'=> $req->email , 'password' =>$req->password])){
             return redirect('admin/trangchu');
       }else{
          return redirect('admin/login')->with('thongbao','Đăng nhập thất bại !!!');
       }
    }
    // dang xuat
    public function getAdminLogout(){
        Auth::logout();
        return redirect('admin/login');
    }
    // get
    public function getDanhSach(){

        $user =  User::where('Xoa',0)->get();
        return view('admin.user.danhsach',
           ['user'=> $user]
        );
    }
    public function getThem(){
        return view('admin.user.them');
    }
    public function getSua($id){
        return view('admin.user.sua',['user'=> User::find($id)]);
    }

    //edit
    public function postThem(Request $req){
            $this->validate($req,[
                'name' =>'required|min:3',
                'email'=>'email|required|unique:users,email',
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'
             ],[
                'name.required' =>'Vui lòng nhập tên',
                'name.min'      =>'Vui lòng nhập tên ít nhất 3 ký tự',
                'email.email'  =>'Vui lòng nhập đúng email',
                'email.required'   =>'Vui lòng nhập email',
                'email.unique'   => 'email đã đã được sử dụng',
                'password.required' =>'Vui lòng nhập mật khẩu',
                'password.min'  =>'Vui lòng nhập mật khẩu ít nhất 3 ký tự',
                'password.max'   =>'Vui lòng nhập mật khẩu không quá 32 ký tự',
                'passwordAgain.required'   =>'Vui lòng nhập lại mật khẩu',
                'passwordAgain.same'       =>'Nhập lại Password không đúng'
             ]);

             $user = new User();
             $user->name = $req->name;
             $user->email = $req->email;
             $user->role = $req->role;
             $user->password = bcrypt($req->password);
             $user->save();
             // thong bao
             return redirect('admin/user/them')->with('thongbao','Thêm thành công');
    }
    public function putSua(Request $req, $id){
        $this->validate($req,[
            'name' =>'required|min:3'
         ],[
            'name.required' =>'Vui lòng nhập tên',
            'name.min'      =>'Vui lòng nhập tên ít nhất 3 ký tự'
         ]);

         $user =User::find($id);
         $user->name = $req->name;
         $user->role = $req->role;
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
         return redirect('admin/user/them')->with('thongbao','Sửa thành công');
    }
    public function deleteXoa( $id){
        $user =  User::find($id);
        $user->Xoa =1;
        $user->save();
        return redirect('admin/user/danhsach')->with('thongbao','Xóa thành công');
    }
}
