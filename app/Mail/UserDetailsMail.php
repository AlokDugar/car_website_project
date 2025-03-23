<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserDetailsMail extends Mailable
{
    use SerializesModels;

    public $user;
    public $password;

    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function build()
    {
        return $this->view('emails.user_details')
                    ->with([
                        'userName' => $this->user->name,
                        'userEmail' => $this->user->email,
                        'password' => $this->password,
                    ])
                    ->subject('Your Account Details');
    }
}
