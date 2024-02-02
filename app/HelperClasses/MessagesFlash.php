<?php

namespace App\HelperClasses;

use Illuminate\Support\Facades\Session;

class MessagesFlash
{
    public static $suc = "Success";
    public static $err = "Error";
    public static $Errors = "Errors";

    /**
     * @param string $process
     * @return mixed
     * @author moner khalil
     */
    public static function Messages(string $process): mixed
    {
        $msg = [
            "create" => __("suc_create",),
            "update" => __("suc_update",),
            "delete" => __("suc_delete",),
            "default" => __("suc_default"),
        ];
        return $msg[$process] ?? $msg['default'];
    }

    /**
     * @param string $process
     * @author moner khalil
     */
    public static function Success(string $process = "",$message = null){
        if (is_null($message)){
            Session::flash(self::$suc,self::Messages($process));
        }else{
            Session::flash(self::$suc,__($message));
        }
    }

    /**
     * @param mixed $errors
     * @author moner khalil
     */
    public static function Errors(mixed $errors){
        if (is_array($errors)){
            Session::flash(self::$err,$errors);
        }else{
            Session::flash(self::$err,__($errors));
        }
    }
}
