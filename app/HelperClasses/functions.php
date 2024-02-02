<?php

use App\HelperClasses\MessagesFlash;
use App\HelperClasses\MyApp;
use App\HelperClasses\StorageFiles;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


function filterDataRequest(){
    return  !is_null(request('filter')) ? request('filter') : [];
}

function Errors($key)
{
    return Session::has(MessagesFlash::$Errors) && isset(Session::get(MessagesFlash::$Errors)[$key])
        ? Session::get(MessagesFlash::$Errors)[$key][0] : null;
}

function Error(){
    return Session::has(MessagesFlash::$err)
        ? Session::get(MessagesFlash::$err) : null;
}

function Success(){
    return Session::has(MessagesFlash::$suc)
        ? Session::get(MessagesFlash::$suc) : null;
}

if (!function_exists('user')) {
    /**
     * @return mixed
     */
    function user(): mixed
    {
        return MyApp::Classes()->getUser();
    }
}

if (!function_exists('urlIsApi')) {
    /**
     * @return mixed
     */
    function urlIsApi(): mixed
    {
        return Request::is('api/*') || Request::is('api');
    }
}
