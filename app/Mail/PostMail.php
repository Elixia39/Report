<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Holiday;
use Carbon\Carbon;

class PostMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $holiday;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($holiday)
    {
        $this->holiday = $holiday;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dt = new Carbon();
        $dt = Carbon::today();

        return $this
        ->subject($dt->format('Y年m月d日').Auth::user()->name.'さん予定')
        ->view('emails.posts.dairy');
    }
}
