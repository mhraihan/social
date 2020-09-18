<?php

namespace App\Console\Commands;

use App\Message;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:OldMessage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used for remove 10 minutes older message';

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
        $messages = Message::whereDate('created_at', '<', Carbon::now()->subMinutes(10));
        $messages->delete();
        // dd($messages);
    }
}
