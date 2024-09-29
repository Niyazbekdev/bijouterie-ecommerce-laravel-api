<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class ServiceClassCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new service class';

    protected function getStub(): string
    {
        return __DIR__ . '/../../../stubs/service.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Services';
    }
}
