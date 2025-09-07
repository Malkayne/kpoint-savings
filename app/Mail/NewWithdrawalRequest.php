<?php

namespace App\Mail;

use App\Models\Withdrawal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewWithdrawalRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $withdrawal;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Withdrawal $withdrawal, User $user)
    {
        $this->withdrawal = $withdrawal;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Withdrawal Request - KPoint Savings')
                    ->view('emails.withdrawal-request')
                    ->with([
                        'withdrawal' => $this->withdrawal,
                        'user' => $this->user
                    ]);
    }
}