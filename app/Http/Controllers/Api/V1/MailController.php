<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use Mail;

class MailController extends Controller {
    public function index(string $code, string $email) {
        try {
            Mail::to($email)->send(new MailNotify($code));
        } catch(Exception $e) {
            return response()->json(['Sorry! Please try again latter']);
        }
    }
}
