<?php

namespace Mints\Clear\Tests;

use Illuminate\Support\Facades\Artisan;
use Mints\Clear\ClearServiceProvider;
use Orchestra\Testbench\TestCase;

class ClearCommandTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ClearServiceProvider::class
        ];
    }

    /**
     * @test
     */
    public function it_runs_command()
    {
        $this->withoutMockingConsoleOutput();

        $this->artisan('clear');

        $output = Artisan::output();

        $this->assertStringContainsString('Logs cleared.', $output);
    }
}