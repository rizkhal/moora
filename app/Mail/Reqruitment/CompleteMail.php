<?php

namespace App\Mail\Reqruitment;

use App\Models\User;
use App\Models\Reqruitment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompleteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private User $user,
        private Reqruitment $reqruitment
    ) {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reqruitment-complete')
            ->subject("Penutupan pendaftaran pada penerimaan {$this->reqruitment->name}")
            ->with([
                'user' => $this->user,
                'reqruitment' => $this->reqruitment,
            ]);
    }
}
