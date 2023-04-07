<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PintCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pint';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs Laravel Pint';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $output = shell_exec('php ./vendor/bin/pint');
        $this->info($output);
    }
}
