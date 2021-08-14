<?php

namespace Mints\Clear\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class SessionClear extends Command
{
    protected $signature = 'session:clear';

    protected $description = 'Clear application session';

    public function handle()
    {
        if (App::environment('production')) {
            $this->error("Could not clear session in production.");
            exit;
        }

        $driver = config('session.driver');
        $method_name = 'clean' . ucfirst($driver);
        if ( method_exists($this, $method_name) ) {
            try {
                $this->$method_name();
                $this->info('Session cleared.');
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
        } else {
            $this->error("Could not clear session for driver '{$driver}'.");
        }
    }

    protected function cleanFile () {
        $directory = config('session.files');
        $ignoreFiles = ['.gitignore', '.', '..'];

        $files = scandir($directory);

        foreach ( $files as $file ) {
            if( !in_array($file,$ignoreFiles) ) {
                unlink($directory . '/' . $file);
            }
        }
    }

    protected function cleanDatabase () {
        $table = config('session.table');
        \DB::table($table)->truncate();
    }
}