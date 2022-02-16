<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Reqruitment;
use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnnouncementMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private User $user,
        private Reqruitment $reqruitment,
        private Announcement $announcement
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
        return $this->view('emails.announcement')
            ->subject($this->announcement->title)
            ->with([
                'user' => $this->user,
                'reqruitment' => $this->reqruitment,
                'announcement' => $this->announcement,
            ]);
    }
}
