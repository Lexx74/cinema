<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Send the email to the admin
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function send(Request $request)
    {
        // TODO send email using Laravel
        $to      = 'nobody@example.com';
        $subject = 'User request from the form';
        $message = $request->input('text');;
        $headers = 'From: '.$request->input('email') . '\r\n' .
            'Reply-To: webmaster@example.com' . '\r\n' .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

        \Session::flash('success_flash_message', 'Your request was successfully sent. We will contact you soon.');

        return redirect('contact');
    }
}
