<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailerController extends Controller
{
    public function index() {
        $data = array(
            'title'     => 'Company added',
            'content'   => 'New Company X is successfully added'
        );

        Mail::send('mailer.index', $data, function($message) {
            $message->to('xtachix012@gmail.com', 'Admin')
                        ->subject('Company Added');

        });
    }
}
