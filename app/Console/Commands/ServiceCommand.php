<?php

namespace App\Console\Commands;

use App\HelperClasses\MyApp;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServiceCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service
    {service*}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $services = $this->argument('service');
        foreach ($services as $service){
            //"test_string" => "TestString"
            $service = MyApp::Classes()->stringProcess->camelCase($service);
            $this->resolveCreateService($service);
        }
        return self::SUCCESS;
    }

    /**
     * @param string $model
     */
    protected function resolveCreateService(string $service)
    {
        $serviceFilePath = app_path() . "/../stubs/service.stub";
        $serviceFile = File::get($serviceFilePath);
        $newServiceFile = str_replace("{{ NAME_CLASS }}", $service, $serviceFile);
        File::put($this->getDependenciesFiles($service, 'service'), $newServiceFile);
    }
}
