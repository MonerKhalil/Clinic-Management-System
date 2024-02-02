<?php

namespace App\Console\Commands;

use App\HelperClasses\MyApp;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class CrudCreateTranslationCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:create_lang
    { model : table main crud }
    {--type=}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create table model with table translation';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $typeCommand = !is_null($this->option("type")) ? $this->option("type") : "all";
        $modelMain = $this->argument('model');
        $nameTable = Str::plural($modelMain);
        system("php artisan crud:create {$modelMain} --type={$typeCommand}");
        $Fk = MyApp::Classes()->languageProcess->getFkTableTranslation();
        $model = MyApp::Classes()->stringProcess->camelCase($modelMain);
        $modelTranslation = $model . "Translation";
        $this->resolveMigrationTranslationCreate($nameTable,$Fk);
        $this->resolveModelTranslationCreate($modelTranslation,$nameTable);
        $this->resolveModelMain($model,$Fk,$modelTranslation);
        return self::SUCCESS;
    }

    private function resolveMigrationTranslationCreate($nameTable,$Fk){
        $interfaceFilePath = app_path() . "/../stubs/migration.create.translation.stub";
        $interfaceFile = File::get($interfaceFilePath);
        $newInterfaceFile = str_replace("{{ table }}", $nameTable, $interfaceFile);
        $newInterfaceFile = str_replace("{{ relation_id_table }}", $Fk, $newInterfaceFile);
        $timestamp = now()->format('Y_m_d_His');
        $nameFile = $timestamp."_create_".$nameTable."_translations_table";
        File::put($this->getDependenciesFiles($nameFile, 'migration'), $newInterfaceFile);
    }

    private function resolveModelTranslationCreate($modelTranslation,$nameTable){
        $interfaceFilePath = app_path() . "/../stubs/model.translation.stub";
        $interfaceFile = File::get($interfaceFilePath);
        $interfaceFile = str_replace("{{ class }}", $modelTranslation, $interfaceFile);
        $interfaceFile = str_replace("{{ table }}", $nameTable, $interfaceFile);
        File::put($this->getDependenciesFiles($modelTranslation, 'model'), $interfaceFile);
    }

    private function resolveModelMain($model,$Fk,$modelTranslation){
        $finalString = $this->getFunctionTranslationMain();
        $finalString .= PHP_EOL."\t// Add relationships between tables section".PHP_EOL;
        $nameFun = "translation";
        $finalString .= $this->getStringFunctionRelation($nameFun,$Fk,$modelTranslation);
        $modelFile = File::get($this->getDependenciesFiles($model, 'model'));
        $newModelFile = str_replace(
            [
                '// Add relationships between tables section',
                'protected $with = [];',
                'extends BaseModel',
                'use App\HelperClasses\MyApp;',
                'use HasFactory;',
            ],
            [
                $finalString,
                'protected $with = ['."'".$nameFun."'".',];',
                'extends BaseTranslationModel',
                'use App\HelperClasses\MyApp;',
                'use HasFactory;'
            ],
            $modelFile
        );
        File::put($this->getDependenciesFiles($model, 'model'), $newModelFile);
    }

    /**
     * @return string
     */
    private function getFunctionTranslationMain(): string
    {
        $function =  "/**".PHP_EOL;
        $function .= "\t".' * @return array'.PHP_EOL;
        $function .= "\t".' */'.PHP_EOL;
        $function .= "\t".'public function attributesTranslations(): array{'.PHP_EOL;
        $function .= "\t\t".'return [];'.PHP_EOL;
        $function .= "\t".'}'.PHP_EOL;
        return $function;
    }

}
