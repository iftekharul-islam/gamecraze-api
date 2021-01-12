<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SendContactEmailToAdmin;
use App\Mail\SendContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendMail(Request $request) {
        SendContactEmailToAdmin::dispatch($request->all());
        // logger('input data: ' . json_encode($request->all()));
        // Mail::to('debashish2@augnitive.com')
        //     ->send(new SendContactMail($request->all()));
        return $this->response->array([
            'error' => false,
            'message' => 'Thank you. We will get back to you soon.'
        ]);
    }
}
