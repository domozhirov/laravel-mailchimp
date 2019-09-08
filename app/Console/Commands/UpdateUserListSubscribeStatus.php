<?php

namespace App\Console\Commands;

use App\UserList;
use Illuminate\Console\Command;

class UpdateUserListSubscribeStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-list:subscribed {status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set subscribe status to all users';

    /**
     * @var bool
     */
    protected $status;

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
     * @return mixed
     */
    public function handle()
    {
        $status = (bool)$this->argument('status');

        if ($status) {
            $this->info('Change status to subscribe');
        } else {
            $this->info('Change status to unsubscribe');
        }

        UserList::query()->update([
            'subscribed' => (int)$status,
        ]);
    }
}
