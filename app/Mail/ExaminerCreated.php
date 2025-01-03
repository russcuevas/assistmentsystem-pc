<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExaminerCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Examiner Account Created')
            ->view('admin.default_id.email.examiner_created')
            ->with([
                'fullname' => $this->user->fullname,
                'email' => $this->user->email,
                'password' => $this->password,
                'default_id' => $this->user->default_id,
            ]);
    }
}
