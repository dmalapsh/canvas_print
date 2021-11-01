<?php

namespace App\Mail;


use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class ResetPasswordShipped extends Mailable {
    use Queueable, SerializesModels;
    public $data;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_id)
    {
    	$this->user = User::find($user_id);
    	$this->to($this->user->email);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	    $pass = '';
	    for ($i = 0; $i < 6; $i++) {
		    $pass .= rand(0,9);
	    }
		$this->user->password = Hash::make($pass);
		$this->user->is_verified = 0;
	    $this->user->save();
        return $this->subject('Пароль для вода в систему')->view('email.reset_password',['pass'=> $pass]);
    }
}
