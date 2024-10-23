<?php

namespace App\Console\Commands;

use App\Enum\GigStatus;
use App\Models\User;
use Illuminate\Console\Command;

class PostedRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:posted-rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the posted rate for all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach($users as $user){

            $numberOfGigs = $user->gigs()->count();

            if($numberOfGigs > 0){ 

                $numberOfpostedGigs = $user->gigs()->where('status', GigStatus::Posted)->count();

                $postedRate = ($numberOfpostedGigs / $numberOfGigs) * 100;

                $user->posted_rate = $postedRate;

                $user->save();

                $this->info("Updated posted rate for user {$user->id}: {$postedRate}%");
            }
        }

        $this->info('Posted rates are updated.');
    }
}
