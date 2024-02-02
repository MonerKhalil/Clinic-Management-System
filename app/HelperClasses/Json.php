<?php

namespace App\HelperClasses;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class Json
{
    /**
     * @param mixed $data
     * @param null $message
     * @return JsonResponse
     * @author moner khalil
     */
    public function dataHandle(mixed $data ,$message = null): JsonResponse
    {
        $finalDate['code'] = 200;
        $finalDate['message'] = Success();
        if (!is_null($message)){
            $finalDate['message'] = Success();
        }
        $finalDate['data'] = [];
        if (is_array($data)){
            foreach ($data as $key => $datum){
                if ($datum instanceof LengthAwarePaginator){
                    $finalDate['data'][$key] = $this->paginate($datum);
                }else{
                    $finalDate['data'][$key] = $datum;
                }
            }
        }else{
            if ($data instanceof LengthAwarePaginator){
                $finalDate['data'] = [
                    "paginate" => $this->paginate($data)
                ];
            }else{
                $finalDate['data'] = $data;
            }
        }

        $response = response()->json($finalDate);
        Log::channel("system_api")->info("the Response is : ".$response);
        return $response;
    }

    /**
     * @param $error
     * @param string|null $exception
     * @param int $code
     * @return JsonResponse
     * @author moner khalil
     */
    public function errorHandle($error,?string $exception = null, int $code): JsonResponse
    {
        $finalError = [
            "code" => $code,
        ];
        if (!is_null($exception)){
            $finalError["exception"] = $exception;
        }
        if (is_array($error)){
            $finalError["errors"] = $error;
        }else{
            $finalError["errors"] = [
                "message" => __($error),
            ];
        }
        $response = response()->json($finalError,$code);
        Log::channel("system_api")->info("the Error is : ".$response);
        return $response;
    }

    /**
     * @param mixed $paginate
     * @return array
     * @author moner khalil
     */
    private function paginate(LengthAwarePaginator $paginate): array
    {
        $allQueryParams = request()->all();
        $paginate = $paginate->appends($allQueryParams);
        return [
            "items" => $paginate->items(),
            "current_page" => $paginate->currentPage(),
            "url_next_page" => $paginate->nextPageUrl(),
            "url_pre_page" => $paginate->previousPageUrl(),
            "url_first_page" => $paginate->url(1),
            "url_last_page" => $paginate->url($paginate->lastPage()),
            "total_pages" => $paginate->lastPage(),
            "total_items" => $paginate->total(),
            "has_more_pages" => $paginate->hasMorePages(),
        ];
    }
}
