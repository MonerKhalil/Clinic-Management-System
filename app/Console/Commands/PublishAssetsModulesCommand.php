<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PublishAssetsModulesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:publish-assets';

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
        $mainPathProcessTarget = public_path("Modules");
        $directories = glob(base_path("Modules") . '/*' , GLOB_ONLYDIR);
        $modulesFile = base_path("modules_statuses.json");
        $contentFile = file_exists($modulesFile) ? json_decode(file_get_contents($modulesFile),true) : null;
        foreach ($directories as $directory) {
            $directory = basename($directory);
            if (isset($contentFile[$directory]) && $contentFile[$directory]){
                $sourcePath = base_path("Modules\\".$directory."\\Resources\\assets");
                $this->recurseCopy($sourcePath,$mainPathProcessTarget . "\\" .$directory."\\Resources\\assets");
                $this->info("✔ assets ".$directory ." ." );
            }
        }
    }

    public function recurseCopy(
        string $sourceDirectory,
        string $destinationDirectory,
        string $childFolder = ''
    ): void {
        $directory = opendir($sourceDirectory);
        if (!is_dir($destinationDirectory)) {
            mkdir($destinationDirectory ,0777, true);
        }

        if ($childFolder !== '') {
            if (is_dir("$destinationDirectory/$childFolder") === false) {
                mkdir("$destinationDirectory/$childFolder");
            }

            while (($file = readdir($directory)) !== false) {
                if ($file === '.' || $file === '..') {
                    continue;
                }

                if (is_dir("$sourceDirectory/$file") === true) {
                    $this->recurseCopy("$sourceDirectory/$file", "$destinationDirectory/$childFolder/$file");
                } else {
                    copy("$sourceDirectory/$file", "$destinationDirectory/$childFolder/$file");
                }
            }

            closedir($directory);

            return;
        }

        while (($file = readdir($directory)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            if (is_dir("$sourceDirectory/$file") === true) {
                $this->recurseCopy("$sourceDirectory/$file", "$destinationDirectory/$file");
            }
            else {
                copy("$sourceDirectory/$file", "$destinationDirectory/$file");
            }
        }

        closedir($directory);
    }
}
