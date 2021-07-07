<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
class MailController extends Controller
{
    //
    public function getThem(){
        return view('admin.mail.them');
    }
    public function postThem(Request $req){

        // kiem tra tham so truyen vao
       $this->validate($req ,[
            'TieuDe' =>'required|min:6',
            'TomTat' =>'required|min:12',
            'link'   =>'required'
       ],[
            'TieuDe.required' =>'Bạn chưa nhập tiêu đề',
            'TieuDe.min'      =>'Tiêu đề ít nhất 6 ký tự',
            'TomTat.required' =>'Bạn chưa nhập tóm tắt',
            'TomTat.min'      =>'Tóm tắt ít nhất 12 ký tự',
            'link.required'   =>'Bạn chưa nhập link'
       ] );

       // chuyen data sang mang
       $TieuDe =  $req->TieuDe;
       $TomTat = $req->TomTat;
       $link   = $req->link;
       $data = [
           'TieuDe' =>$TieuDe,
           'TomTat' =>$TomTat,
           'link'   =>$link
       ];

       // chuyen data gmail sang mang
       $lstuserGmail = User::where('role','0')->get();
       // chuyen sang mang
       $email =[];
       foreach ($lstuserGmail as $ug) {
          $email[] =  $ug->email;
       }   

        Mail::send('mail.thongbaotinmoi',$data , function ($message) use ($email){
            $message->from('nguyenminhhieu28092001k3@gmail.com', 'Hieu Minh');
            $message->to($email, 'Bạn');
            $message->subject('Tin tức mới bởi HM news');
    
            // $message->attach( $req->file('txtFile')->getRealPath(), [
            //     'as' => $req->file('txtFile')->getClientOriginalName(),
            //     'mime' =>  $req->file('txtFile')->getMimeType()
            //  ]);
        });
       return redirect('admin/mail/them')->with('thongbao','Gửi thành công');
    }

}
