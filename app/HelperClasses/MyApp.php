<?php

namespace App\HelperClasses;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Route;

class MyApp
{
    public const RouteHome = "dashboard";

    public const PAGINATE_NAME_SETTING = "PAGINATE_DEFAULT";

    public const DEFAULT_PAGES_Count = 10;

    /**
     * @var MyApp|null
     * @author moner khalil
     */
    private static MyApp|null $app = null;

     /**
     * @var Json|null
     * @author moner khalil
     */
    public ?Json $json = null;

    /**
     * @var StorageFiles|null
     * @author moner khalil
     */
    public ?StorageFiles $storageFiles = null;

    /**
     * @var LogMain|null
     * @author moner khalil
     */
    public ?LogMain $logMain = null;

    private function __construct()
    {
        $this->json = new Json();
        $this->logMain = new LogMain();
        $this->Search = new SearchModel();
        $this->storageFiles = new StorageFiles();
    }

    /**
     * @return MyApp
     * @author moner khalil
     */
    public static function Classes(): MyApp
    {
        if (is_null(self::$app)){
            self::$app = new static();
        }
        return self::$app;
    }

    /**
     * @return Authenticatable|null
     */
    public function getUser(): ?Authenticatable
    {
        if (urlIsApi()){
            return \auth("user_api")->user();
        }
        return \auth()->user();
    }

    public function mainRoutes($url,$controller){
        Route::resource($url,$controller);
        Route::prefix($url)
            ->controller($controller)
            ->group(function (){
                Route::put("active_deactivate/{id}","active");
                Route::delete("delete/multi","multiDestroy");
            });
    }

}
