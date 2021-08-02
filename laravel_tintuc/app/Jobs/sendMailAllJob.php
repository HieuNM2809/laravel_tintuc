<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendMailAllJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //khoi tao 
    private $data = [];
    private $email = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $email)
    {
        //
        $this->data = $data;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::send('mail.thongbaotinmoi',$this->data , function ($message){
            $message->from('nguyenminhhieu28092001k3@gmail.com', 'Hieu Minh');
            $message->to($this->email, 'Bạn');
            $message->subject('Tin tức mới bởi HM news');

            // $message->attach( $req->file('txtFile')->getRealPath(), [
            //     'as' => $req->file('txtFile')->getClientOriginalName(),
            //     'mime' =>  $req->file('txtFile')->getMimeType()
            //  ]);
        });
    }
}
