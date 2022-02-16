<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Reqruitment;
use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use App\Mail\AnnouncementMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AnnouncementJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private Announcement $announcement
    ) {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->announcement->reqruitments()->each(function (Reqruitment $reqruitment) {
            $reqruitment->users()->each(function (User $user) use ($reqruitment) {
                Mail::to($user->email)->send(new AnnouncementMail($user, $reqruitment, $this->announcement));

                Log::info('Send Announcement Email', [
                    'email' => $user->email,
                ]);
            });
        });
    }
}
