<?php

namespace App\Console\Commands;

use App\HelperClasses\MyApp;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CrudDestroyCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:destroy {model*}';

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
        foreach ($models as $item){
            $model = MyApp::Classes()->stringProcess->camelCase($item);

            $modelAsKebab = Str::kebab($model);

            $listOfFiles = $this->getDependenciesFiles($model);

            $listOfFiles['viewDir'] = str_replace($model, $modelAsKebab, $listOfFiles['viewDir']);

            $listOfFiles['view'] = str_replace($model, $modelAsKebab, $listOfFiles['view']);

            $isDeleteAnyThing = false;

            foreach ($listOfFiles as $file) {
                if (File::exists($file) && File::isFile($file)) {
                    $isDeleteAnyThing = true;
                    File::delete($file);
                }
                if (File::exists($file) && File::isDirectory($file)) {
                    $isDeleteAnyThing = true;
                    File::deleteDirectory($file);
                }
            }
            if (!$isDeleteAnyThing) {
                $this->error("the model $model not found !");
            } else {
                $this->resolveRoutesToRemoveModel($modelAsKebab);
                $this->line("<info>The Model $model was deleted with his dependencies successfully </info>, and please remove the migration file manual");
            }
        }

        return self::SUCCESS;
    }
}
