<?php

namespace Database\Seeders;

use App\Models\BaseModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguageSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SettingControlSeeder::class);
    }

    public static function createData($class, $count = 1000)
    {
        $model = (new $class);
        if ($model instanceof BaseModel) {
            $fields = $model->viewFieldsValidationFrontEnd();
            $fields = ignoreFieldsCreate($fields);
            $data = [];
            for ($i = 1; $i <= $count; $i++) {
                foreach ($fields as $key => $val) {
                    if (is_array($val)) {
                        if (isset($val['select'])) {
                            $data[$key] = $val['select'][0] ?? $i;
                        } else {
                            $data[$key] = $i;
                        }
                    } else {
                        info($val);
                        $val = explode("|", $val);
                        if ($val[0] == "date") {
                            $data[$key] = now();
                        } else {
                            $data[$key] = $i;
                        }
                    }
                }
                if (in_array("slug", $model->getFillable())) {
                    $data["slug"] = $i;
                }
                $model->create($data);
            }
        }
    }
}
