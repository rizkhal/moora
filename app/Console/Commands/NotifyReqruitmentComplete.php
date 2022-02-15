<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Reqruitment;
use Illuminate\Console\Command;
use App\Enums\ReqruitmentStatus;
use App\Jobs\Reqruitment\CompleteJob as ReqruitmentCompleteJob;

class NotifyReqruitmentComplete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reqruitment:complete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify when reqruitment complete';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->format('Y-m-d');

        $reqruitments = Reqruitment::query()->with('users')->whereEndAt($today)
            ->whereStatus(ReqruitmentStatus::OPEN->value)
            ->get();

        if ($reqruitments->isNotEmpty()) {
            $reqruitments->each(function (Reqruitment $reqruitment) {
                $reqruitment->users()->each(function (User $user) use ($reqruitment) {
                    dispatch(new ReqruitmentCompleteJob($user, $reqruitment));
                });

                // close the reqruitment
                $reqruitment->update([
                    'status' => ReqruitmentStatus::CLOSED->value
                ]);
            });
        }
    }
}
