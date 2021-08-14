<?php

namespace Mints\Clear\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class Clear extends Command
{
    protected $signature = 'clear';

    protected $description = 'Clear application';

    public function handle()
    {
        if (App::environment('local')) {
            \File::cleanDirectory('storage/app/public');
            $this->comment('Storage cleared.');

            \Artisan::call('session:clear');
        }

        \Artisan::call('cache:clear');
        $this->comment('Cache cleared.');

        \Artisan::call('view:clear');
        $this->comment('View cleared.');

        \Artisan::call('route:clear');
        $this->comment('Route cleared.');

        \Artisan::call('config:clear');
        $this->comment('Config cleared.');

        \Artisan::call('log:clear');

        $this->comment('Application cleared.');
    }
}