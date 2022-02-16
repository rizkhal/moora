<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Reqruitment;
use App\Models\Announcement;
use Illuminate\Console\Command;
use App\Enums\ReqruitmentStatus;
use Illuminate\Support\Facades\DB;
use App\Jobs\ReqruitmentCompleteJob;

class NotifyReqruitmentCompleteCommand extends Command
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
        $today = Carbon::today()->toDateString();

        $reqruitments = Reqruitment::query()->active()->with('users')
            ->whereDate('end_at', $today)->get();

        if ($reqruitments->isNotEmpty()) {
            $reqruitments->each(function (Reqruitment $reqruitment) {
                $reqruitment->users()->each(function (User $user) use ($reqruitment) {
                    dispatch(new ReqruitmentCompleteJob($user, $reqruitment));
                });

                DB::transaction(function () use ($reqruitment) {
                    $announcement = Announcement::create([
                        'title' => "Penutupan penerimaan {$reqruitment->name}",
                        'content' => "Penutupan penerimaan pada {$reqruitment->name}",
                    ]);

                    $announcement->reqruitments()->sync([
                        'reqruitment_id' => $reqruitment->id,
                    ]);

                    // close the reqruitment
                    $reqruitment->update([
                        'status' => ReqruitmentStatus::CLOSED->value
                    ]);
                });
            });
        }
    }
}
