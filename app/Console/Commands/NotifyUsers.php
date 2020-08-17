<?php

namespace App\Console\Commands;

use App\Jobs\RentDeadlineToAdmin;
use App\Jobs\RentDeadlineToUser;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Doctrine\CarbonDoctrineType;
use Illuminate\Console\Command;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $currentDate = '15 09 2020';
        $users = User::with('lends')->whereNotNull('email')->get();
        $admins = User::role('Admin')->get();
        $this->info($admins);
        foreach ($users as $user) {
            foreach ($user->lends as $lend) {
                $endDate = Carbon::parse($lend->lend_date)->addDays($lend->lend_week * 7 + 1);
                $notifyDate = $endDate->addDays(-2)->format('d m Y');
                if ($currentDate == $notifyDate) {
                    RentDeadlineToUser::dispatch($user, $endDate);
                    foreach ($admins as $admin) {
                        RentDeadlineToAdmin::dispatch($user, $admin, $endDate);
                    }
                }
                return false;
            }
        }
    }
}
