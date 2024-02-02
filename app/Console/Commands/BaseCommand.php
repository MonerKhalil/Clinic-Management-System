<?php

namespace App\Console\Commands;

use App\HelperClasses\MyApp;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:create {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @param string $model
     * @param null $type
     * @return mixed
     */
    protected function getDependenciesFiles(string $model, $type = null): mixed
    {
        $arr = [
            'repositoryInterface' => app_path("Http/Repositories/Interfaces/I{$model}Repository.php"),
            'repository' => app_path("Http/Repositories/Eloquent/{$model}Repository.php"),
            'composer' => app_path("Http/Views/{$model}Composer.php"),
            'request' => app_path("Http/Requests/{$model}Request.php"),
            'controllerFoRoute' => "\\App\\Http\\Controllers\\{$model}Controller",
            'model' => app_path("Models/$model.php"),
            'modelTranslation' => app_path("Models/{$model}Translation.php"),
            'controller' => app_path("Http/Controllers/{$model}Controller.php"),
            'viewDir' => resource_path("views/pages/$model"),
            'view' => resource_path("views/pages/$model/index.blade.php"),
            'view_create' => resource_path("views/pages/$model/create.blade.php"),
            'view_update' => resource_path("views/pages/$model/update.blade.php"),
            'seeder' => database_path("seeders/{$model}Seeder.php"),
            'migration' => database_path("migrations/$model.php"),
            'mail_service' => base_path("Modules/EmailTemplate/Services/Mails/{$model}MailService.php"),
            'service' => app_path("Services/{$model}Service.php"),
        ];
        return $arr[$type] ?? $arr;
    }

    /**
     * @param string $model
     */
    protected function resolveCreateRepositories(string $model)
    {
        $interfaceFilePath = app_path() . "/../stubs/repository.interface.stub";
        $interfaceFile = File::get($interfaceFilePath);

        $newInterfaceFile = str_replace("{{ model }}", $model, $interfaceFile);
        File::put($this->getDependenciesFiles($model, 'repositoryInterface'), $newInterfaceFile);

        $eloquentFile = File::get(app_path() . "/../stubs/repository.eloquent.stub");
        $newEloquentFile = str_replace("{{ model }}", $model, $eloquentFile);
        File::put($this->getDependenciesFiles($model, 'repository'), $newEloquentFile);
    }

    /**
     * @param string $model
     * @param string $modelAsKebab
     */
    protected function resolveControllerAfterCreateIt(string $model,string $modelAsKebab)
    {
        $controllerFile = File::get($this->getDependenciesFiles($model, 'controller'));
        $newControllerFile = str_replace("{{ model | lowercase }}", $modelAsKebab, $controllerFile);
        File::put($this->getDependenciesFiles($model, 'controller'), $newControllerFile);
    }

    /**
     * @param string $model
     * @param string $modelAsKebab
     */
    protected function createView(string $model,string $modelAsKebab)
    {
        $viewFile = File::get(app_path() . "/../stubs/view.stub");
        $viewCreateFile = File::get(app_path() . "/../stubs/create.view.stub");
        $viewUpdateFile = File::get(app_path() . "/../stubs/update.view.stub");
        #View
        mkdir($this->getDependenciesFiles($modelAsKebab, 'viewDir'));
        File::put($this->getDependenciesFiles($modelAsKebab, 'view'), $viewFile);
        File::put($this->getDependenciesFiles($modelAsKebab, 'view_create'), $viewCreateFile);
        File::put($this->getDependenciesFiles($modelAsKebab, 'view_update'), $viewUpdateFile);
        #Composer
        $composerViewFile = File::get(app_path() . "/../stubs/view.composer.stub");
        $newComposerViewFile = str_replace(
            ["{{ model }}", "{{ model | lowercase }}"],
            [$model, $modelAsKebab],
            $composerViewFile
        );
        File::put($this->getDependenciesFiles($model, 'composer'), $newComposerViewFile);
    }

    /**
     * @param string $model
     */
    protected function resolveCreateRequest(string $model)
    {
        $requestFile = File::get($this->getDependenciesFiles($model, 'request'));
        $newRequestFile = str_replace("{{ model }}", $model, $requestFile);
        File::put($this->getDependenciesFiles($model, 'request'), $newRequestFile);
    }

    /**
     * @param string $string
     * @param string $modelAsKebab
     */
    protected function registerRoute(string $string,string $modelAsKebab,$type)
    {
        if ($type === "api"){
            $this->info("api");
            $this->mainProcessRouteRegister($string,$modelAsKebab,true);
        }elseif ($type === "web"){
            $this->info("web");
            $this->mainProcessRouteRegister($string,$modelAsKebab);
        }else{
            $this->info("all");
            $this->mainProcessRouteRegister($string,$modelAsKebab);
            $this->mainProcessRouteRegister($string,$modelAsKebab,true);
        }

    }

    private function mainProcessRouteRegister(string $string,string $modelAsKebab,bool $type = false){
        $routesFile = MyApp::Classes()->getRouteJsonFile($type);

        $routes = json_decode($routesFile, true) ?? [];

        $routes[$modelAsKebab] = $this->getDependenciesFiles($string, 'controllerFoRoute');

        File::put(MyApp::Classes()->getRouteJsonPath($type), json_encode($routes));
    }

    /**
     * @param string $model
     * @param string $modelAsKebab
     */
    protected function resolveModelAfterCreateIt(string $model, string $modelAsKebab)
    {
        $modelFile = File::get($this->getDependenciesFiles($model, 'model'));
        $newModelFile = str_replace(
            ["{{ model | lowercase }}"],
            [$modelAsKebab],
            $modelFile
        );
        File::put($this->getDependenciesFiles($model, 'model'), $newModelFile);
    }

    /**
     * @param $model
     */
    protected function resolveRoutesToRemoveModel($model)
    {
        $routes = MyApp::Classes()->getRouteJsonFile();

        $routes = json_decode($routes, true);

        unset($routes[$model]);

        File::put(MyApp::Classes()->getRouteJsonPath(), json_encode($routes));

        $routes = MyApp::Classes()->getRouteJsonFile(true);

        $routes = json_decode($routes, true);

        unset($routes[$model]);

        File::put(MyApp::Classes()->getRouteJsonPath(true), json_encode($routes));
    }

    /**
     * @param $nameFun
     * @param $Fk
     * @param $nameModelRelation
     * @return string
     * @author moner khalil
     */
    protected function getStringFunctionRelation($nameFun, $Fk, $nameModelRelation): string
    {
        $function = "    public function {$nameFun}(){";
        $function .= PHP_EOL;
        $function .= '        return $this->hasMany('.$nameModelRelation.'::class,"'.$Fk.'","id");';
        $function .= PHP_EOL."    }".PHP_EOL;
        return $function;
    }

}
