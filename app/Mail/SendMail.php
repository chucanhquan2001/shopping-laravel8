<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;


class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $invoice_hr, $name, $address, $phone, $email, $note, $cart, $totalPrice;
    public function __construct($invoice_hr, $name, $address, $phone, $email, $note, $cart, $totalPrice)
    {
        $this->invoice_hr = $invoice_hr;
        $this->address = $address;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->note = $note;
        $this->cart = $cart;
        $this->totalPrice = $totalPrice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('chucanhquan2001@gmail.com', 'ANHQUANSTORE')->subject('Đơn hàng xác nhận ngày ' . Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'))->view('mails.demo');
    }
}