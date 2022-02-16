<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Reqruitment;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReqruitmentCompleteMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ReqruitmentCompleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(
            new ReqruitmentCompleteMail($this->user, $this->reqruitment)
        );
    }
}
