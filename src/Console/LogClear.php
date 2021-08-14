<?php

namespace Mints\Clear\Console;

use Illuminate\Console\Command;

class LogClear extends Command
{
    protected $signature = 'log:clear';

    protected $description = 'Clear application log';

    public function handle()
    {
        array_map('unlink', array_filter((array) glob(storage_path('logs/*.log'))));
        $this->info('Logs cleared.');
    }
}