<?php

namespace App\Mail;

use App\Models\Report;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PostSent extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $report;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        $this->report = $report;
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
        ->subject($dt->format('Y年m月d日').Auth::user()->name.'さん日報')
        ->view('emails.posts.sents');
    }
}
