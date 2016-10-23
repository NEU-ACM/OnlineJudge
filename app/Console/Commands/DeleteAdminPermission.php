<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class DeleteAdminPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:delete {userid?} {--U|uid=} {--N|username=}';

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
     * @return mixed
     */
    public function handle()
    {
        if($this->argument('userid') != NULL)
            $uid = $this->argument('userid');
        else 
            $uid = $this->option('uid');
        $username = $this->option('username');
        if($uid == NULL && $username == NULL)
        {
            $this->info("Please input uid or username");
            return;
        }
        if($uid != NULL)
            $userObj = User::where('uid', $uid)->first();
        else if($username != NULL)
            $userObj = User::where('username', $username)->first();
        if($userObj == NULL)
        {
            $this->info("User doesn't exists!");
            return;
        }
        $userObj->gid = 0;
        $userObj->save();
        $this->info("User $userObj->username has been changed to a user");
    }
}
