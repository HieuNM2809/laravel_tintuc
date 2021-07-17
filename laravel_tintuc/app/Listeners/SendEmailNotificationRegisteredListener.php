<?php

namespace App\Listeners;

use App\Events\RegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailNotificationRegisteredListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RegisteredEvent  $event
     * @return void
     */
    public function handle(RegisteredEvent $event)
    {
        $data = [
            'name' =>  $event->user->name,
            'email' => $event->user->email,
            'pass' =>  $event->pass,
        ];
        Mail::send('mail.thongBaoDangKyThanhCong', $data, function ($message) use( $data ) {
            $message->from('nguyenminhhieu28092001k3@gmail.com', 'HM tin tức');
            $message->to($data['email'], $data['name']);
            $message->subject('Thông báo đăng ký thành công');
        });
    }
}
