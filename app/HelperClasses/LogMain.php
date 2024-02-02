<?php

namespace App\HelperClasses;

use Illuminate\Support\Facades\Log;

class LogMain
{
    private string $FileLog = "system";

    private mixed $request;

    public function __construct()
    {
        $this->request = request();
    }

    /**
     * @param string $process
     * @param mixed $data
     * @param string|null $fileLog
     */
    public function logProcess(string $process , mixed $data , string $fileLog = null):void{
        $LogData = null;
        $LogData["process"] = $process;

        $LogData ["request"] = [
            "url" => $this->request ->getUri(),
            "method" => $this->request ->getMethod(),
            "body" => $this->request ->all(),
        ];

        $LogData["body"] = $data;

        $fileLog = is_null($fileLog) ? $this->FileLog : $fileLog;

        Log::channel($fileLog)->info(json_encode($LogData));
    }
}
