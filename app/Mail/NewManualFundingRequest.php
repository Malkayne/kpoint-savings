<?php

namespace App\Mail;

use App\Models\Manualfund;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewManualFundingRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $manualFunding;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Manualfund $manualFunding)
    {
        $this->manualFunding = $manualFunding;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Manual Funding Request - K-Point Savings')
                    ->view('emails.new-manual-funding-request')
                    ->with([
                        'manualFunding' => $this->manualFunding,
                        'user' => $this->manualFunding->user
                    ]);
    }
}