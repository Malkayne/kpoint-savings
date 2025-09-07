<?php

namespace App\Mail;

use App\Models\Manualfund;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewManualFundingRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $manualFunding;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Manualfund $manualFunding, User $user)
    {
        $this->manualFunding = $manualFunding;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Manual Funding Request - KPoint Savings')
                    ->view('emails.manual-funding-request')
                    ->with([
                        'manualFunding' => $this->manualFunding,
                        'user' => $this->user
                    ]);
    }
}