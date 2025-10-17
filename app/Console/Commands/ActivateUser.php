<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ActivateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:activate {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activate a user account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found!");
            return 1;
        }

        $currentStatus = $user->status ? 'active' : 'inactive';
        $this->info("Current status: {$currentStatus}");

        $user->update(['status' => true]);

        $this->info("User {$email} has been activated successfully!");

        return 0;
    }
}