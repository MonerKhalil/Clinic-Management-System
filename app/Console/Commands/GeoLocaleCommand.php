<?php

namespace App\Console\Commands;

use Database\Seeders\GeoLocale\GeoLocaleDatabaseSeeder;


class GeoLocaleCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geo:migrate_fresh_seed';

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
        system("php artisan migrate:refresh --path=database/migrations/GeoLocale");
        $this->call(GeoLocaleDatabaseSeeder::class);
        return self::SUCCESS;
    }
}
