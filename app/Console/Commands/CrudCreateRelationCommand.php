<?php

namespace App\Console\Commands;

use App\HelperClasses\MyApp;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class CrudCreateRelationCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:relations
    { model : table main crud }
    { relations* : tables relation from table main }
    {--type=}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create table model with relations';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $typeCommand = !is_null($this->option("type")) ? $this->option("type") : "all";
        $modelMain = $this->argument('model');
        $nameTableModelMain = Str::plural($modelMain);
        system("php artisan crud:create {$modelMain} --type={$typeCommand}");
        $model = MyApp::Classes()->stringProcess->camelCase($modelMain);
        $relations = [];
        foreach ($this->argument('relations') as $relation){
            $nameTableModelRelation = Str::plural($relation);
            $nameModelRelation = MyApp::Classes()->stringProcess->camelCase($relation);
            $modelAsKebabRelation = Str::kebab($nameModelRelation);
            $relations[$relation] = [
                "Fk" => $modelMain."_id",
                "nameFun" => $relation,
                "nameModelRelation" => $nameModelRelation,
            ];
            system("php artisan make:seeder {$nameModelRelation}Seeder");
            #Repositories
            $this->resolveCreateRepositories($nameModelRelation);
            $this->info('repository was created successfully');
            #Request
            system("php artisan make:request {$nameModelRelation}Request");
            $this->resolveCreateRequest($nameModelRelation);
            $this->info('request class was created successfully');
            #View and Composer
            $this->createView($nameModelRelation,$modelAsKebabRelation);
            #Route
            $this->registerRoute($nameModelRelation,$modelAsKebabRelation,$typeCommand);
            $this->info('Route and View created successfully');
            #Model
            $this->resolveModelRelationCreate($model,$nameTableModelMain,$relations[$relation]["Fk"],$modelMain,$nameModelRelation,$modelAsKebabRelation);
            $this->info('Model Relation '.$relation.' created successfully');
            $this->resolveMigrationRelationCreate($nameTableModelMain,$relations[$relation]["Fk"],$nameTableModelRelation);
            $this->info('Migration Relation '.$relation.' created successfully');
            #Controller
            system("php artisan make:controller {$nameModelRelation}Controller -m {$nameModelRelation}");
            $this->resolveControllerAfterCreateIt($nameModelRelation,$modelAsKebabRelation);
        }
        $this->resolveModelMainAfterCreate($model,$relations);
        return self::SUCCESS;
    }

    private function resolveModelMainAfterCreate($model,$relations)
    {
        $finalString = "// Add relationships between tables section".PHP_EOL;
        foreach ($relations as $relation){
            $finalString .= $this->getStringFunctionRelation($relation['nameFun'],$relation['Fk'],$relation['nameModelRelation']);
        }
        $modelFile = File::get($this->getDependenciesFiles($model, 'model'));
        $newModelFile = str_replace(
            ["// Add relationships between tables section"],
            [$finalString],
            $modelFile
        );
        File::put($this->getDependenciesFiles($model, 'model'), $newModelFile);
    }

    private function resolveModelRelationCreate($modelMain,$nameTableModelMain,$relation_id,$relationFun,$modelRelation,$modelAsKebabRelation){
        $interfaceFilePath = app_path() . "/../stubs/model.relation.stub";
        $interfaceFile = File::get($interfaceFilePath);

        $newInterfaceFile = str_replace("{{relation_id}}", $relation_id, $interfaceFile);
        $newInterfaceFile = str_replace("{{relation_id_table}}", $relationFun, $newInterfaceFile);
        $newInterfaceFile = str_replace("{{model_relation}}", $modelMain, $newInterfaceFile);
        $newInterfaceFile = str_replace("{{table_name_relation}}", $nameTableModelMain, $newInterfaceFile);
        $newInterfaceFile = str_replace("{{ model }}", $modelRelation, $newInterfaceFile);
        $newInterfaceFile = str_replace("{{ model | lowercase }}", $modelAsKebabRelation, $newInterfaceFile);

        File::put($this->getDependenciesFiles($modelRelation, 'model'), $newInterfaceFile);
    }

    private function resolveMigrationRelationCreate($nameTableModelMain,$relation_id,$relation_table){
        $interfaceFilePath = app_path() . "/../stubs/migration.create.relation.stub";
        $interfaceFile = File::get($interfaceFilePath);

        $newInterfaceFile = str_replace("{{ table }}", $relation_table, $interfaceFile);
        $newInterfaceFile = str_replace("{{ relation_id_table }}", $relation_id, $newInterfaceFile);
        $newInterfaceFile = str_replace("{{ nameTableModelMain }}", $nameTableModelMain, $newInterfaceFile);
        $timestamp = now()->format('Y_m_d_His');
        $nameFile = $timestamp."_create_".$relation_table."_table";
        File::put($this->getDependenciesFiles($nameFile, 'migration'), $newInterfaceFile);
    }

}
