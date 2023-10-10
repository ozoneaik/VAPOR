<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class SendMailController extends Controller
{
    //
    public function index()
    {
        $content = [
            'subject' => 'This is the mail subject',
            'body' => Auth::user()->name.' '.'ภูวเดช พาณิชยโสภา ต้องการให้คุณช่วยยินยอมในการปฏิบัติงานแทนในระหว่างที่เขาลา😊😊😊😊😊😊'
        ];

        Mail::to(Auth::user()->email)->send(new TestEmail($content));

        return back();
    }
}
