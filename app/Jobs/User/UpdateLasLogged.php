<?php

namespace App\Jobs\User;

use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateLasLogged implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $date;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Carbon $date)
    {
        $this->user = $user;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo $this->user->name . ' is last logged in at ' . $this->date . '\n';
        // $this->user->update(
        //     [
        //         'last_login' => $this->date
        //     ]
        // );
        // $this->user->lol();
        $this->user->last_login = $this->date;
        $this->user->save();
    }

    public function failed()
    {
        log("User last logged in cannot updated {$this->user->id}");
    }
}
