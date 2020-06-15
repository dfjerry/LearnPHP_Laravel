<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\MailToUserAfterOrderCreate;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailToUserAfterOderCreated
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
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;//lấy đơn hàng -> lấy đc người dùng -> lấy đc email
        $user = User::find($order->__get("user_id"));//find người dùng đã đặt đơn hàng
        try {
            Mail::to($user->__get("email"))
                ->send(new MailToUserAfterOrderCreate($user));
        }catch (\Exception $exception){

        }

    }
}
