<?php

namespace App\Console\Commands\Api;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class ApiRequestCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:api-request { name }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create A Custrom ApiFormRequest ';


    protected function getStub()
    {
        return __DIR__ . "/stubs/api-request.stub";
    }



    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . "/Http/ApiRequests";
    }
}

