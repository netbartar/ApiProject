<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EchoHi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cando:echoHi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'echo hi';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo "hi";
    }
}
