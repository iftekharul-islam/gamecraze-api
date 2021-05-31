<?php

namespace App\Jobs;

use App\Mail\SendReminderMail;
use App\Models\Game;
use App\Models\GameReminder;
use App\Models\Rent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $game_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($game_id)
    {
        $this->game_id = $game_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $game = Game::findOrFail($this->game_id);
        $game_link =  env('GAMEHUB_FRONT') .'/game-details/'. $game->id;
        $users = GameReminder::with('user')->where('game_id', $this->game_id)
            ->where('is_sent', 0)
            ->get();
        logger($users);
        if (count($users) > 0){
            foreach ($users as $user) {
                if ($user->user['email'] != null){
                    Mail::to($user->user->email)->queue(new SendReminderMail($game->name, $game_link));
                    $user->is_sent = 1;
                    $user->save();
                }
            }
        }

    }
}
