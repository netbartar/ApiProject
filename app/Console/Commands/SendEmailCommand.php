<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cando:sendEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to application users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      $users = User::all();
      foreach ($users as $user)
      {
          Log::info("send email to $user->email");
      }
    }
}
