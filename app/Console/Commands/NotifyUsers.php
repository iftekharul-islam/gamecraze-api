<?php

namespace App\Console\Commands;

use App\Jobs\RentDeadlineToAdmin;
use App\Jobs\RentDeadlineToUser;
use App\Models\Lender;
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
        $currentDate = Carbon::today()->format('d m Y');
        $lends = Lender::with('lender', 'rent.game')->where('status', 3)->get();
        logger('lends');
        logger($lends);
        $admins = User::role('Admin')->get();
        foreach ($lends as $lend) {
            $rentStartDate = $lend->updated_at;
            $endDateFormat = Carbon::parse($lend->updated_at)->addDays($lend->lend_week * 7 );
            $endDate = $endDateFormat->format('d m Y');

            if ($lend->rent->disk_type != 1) {
                logger('digital disk');
                $rentStartDate = $lend->created_at;
                $endDateFormat = Carbon::parse($lend->created_at)->addDays($lend->lend_week * 7 + 1);
                $rentDateHour = Carbon::parse($lend->created_at)->format('H:i');
                logger($rentDateHour);
                if ($rentDateHour > '12:00'){
                    $endDateFormat = Carbon::parse($lend->created_at)->addDays($lend->lend_week * 7 + 2);
                }
                $endDate = $endDateFormat->format('d m Y');
            }
            logger('rent date');
            logger($rentStartDate);

            logger('end date');
            logger($endDate);

            $notifyDate = $endDateFormat->addDays(-1)->format('d m Y');

            logger('notify date');
            logger($notifyDate);

            if ($currentDate == $notifyDate) {
                logger('in the mail sent section');
                RentDeadlineToUser::dispatch($lend, $endDate);
                foreach ($admins as $admin) {
                    RentDeadlineToAdmin::dispatch($lend, $admin, $endDate);
                }
            }
        }
    }
}
