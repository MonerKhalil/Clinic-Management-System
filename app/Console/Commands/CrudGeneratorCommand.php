<?php

namespace App\Console\Commands;

use App\HelperClasses\MyApp;
use Illuminate\Support\Str;

class CrudGeneratorCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:create
    {model*}
    {--type=}
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
        $models = $this->argument('model');
        $typeCommand = !is_null($this->option("type")) ? $this->option("type") : "all";
        foreach ($models as $model){
            //"test_string" => "TestString"
            $model = MyApp::Classes()->stringProcess->camelCase($model);
            $modelAsKebab = Str::kebab($model);
            $this->info('this will automatically create controller, model, request, and repository ,  please wait a minute (-__-)');
            #Repositories
            $this->resolveCreateRepositories($model);
            $this->info('repository was created successfully');
            #Model Migration Seeder
            system("php artisan make:model -m {$model}");
            system("php artisan make:seeder {$model}Seeder");
            $this->resolveModelAfterCreateIt($model,$modelAsKebab);
            $this->info('model with migration and seeder file was created successfully');
            #Controller
            system("php artisan make:controller {$model}Controller -m {$model}");
            $this->resolveControllerAfterCreateIt($model,$modelAsKebab);
            $this->info('Controller was created successfully');
            #Request
            system("php artisan make:request {$model}Request");
            $this->resolveCreateRequest($model);
            $this->info('request class was created successfully');
        }
        return self::SUCCESS;
    }
}
