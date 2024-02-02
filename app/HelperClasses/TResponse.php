<?php

namespace App\HelperClasses;

trait TResponse
{
    /**
     * @param string|null $ViewName
     * @param mixed|null $Data
     * @param string|null $msgProcess
     * @param string|null $RouteName
     * @param bool $isBack
     * @param array $parametersRouteName
     * @return mixed
     * @author moner khalil
     */
    public function responseSuccess(
        string $ViewName = null, mixed $Data = null,
        string $msgProcess = null, string $RouteName = null, bool $isBack = false,
        array $parametersRouteName = []
    ):mixed
    {
        if (!is_null($msgProcess)){
            MessagesFlash::Success($msgProcess,$msgProcess);
        }

        if (urlIsApi() || (is_null($ViewName) && is_null($RouteName) && !$isBack)){
            return MyApp::Classes()->json->dataHandle($Data,$msgProcess);
        }
        if (!is_null($ViewName)){
            return !is_null($Data) ? response()->view($ViewName,$Data) : response()->view($ViewName);
        }
        if ($isBack){
            return redirect()->back();
        }
        if (!is_null($RouteName)){
            return redirect()->route($RouteName,$parametersRouteName);
        }
        return null;
    }

    public function responseError(mixed $error,string $exception = null , bool $isBack = true,
        string $ViewName = null, string $RouteName = null, int $code = 400
    ):mixed{
        MessagesFlash::Errors($error);
        if (urlIsApi() || request()->ajax()){
            return MyApp::Classes()->json->errorHandle($error,$exception,$code);
        }
        if ($isBack){
            return redirect()->back();
        }
        if (!is_null($ViewName)){
            return response()->view($ViewName);
        }
        if (!is_null($RouteName)){
            return redirect()->route($RouteName);
        }
        return null;
    }
}
