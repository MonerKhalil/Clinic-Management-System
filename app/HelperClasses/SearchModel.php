<?php

namespace App\HelperClasses;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SearchModel
{
    private mixed $request;
    private const DATATYPE_DATE = ['date', 'year'];
    private const DATATYPE_Time = ['datetime','time','timestamp',];
    private const DATATYPE_CHARS = ['char', 'varchar', 'binary', 'varbinary', 'text', 'tinytext', 'mediumtext', 'longtext', 'enum', 'set'];

    public function __construct()
    {
        $this->request = request();
    }

    /**
     * @param $tableName
     * @param $model
     * @param $queryBuilder
     * @param ?array $filter
     * @param bool|null $isAll
     * @param string|null $nameDateFilter
     * @param callable|null $callback
     * @return mixed
     * @author moner khalil
     */
    public function getDataFilter($queryBuilder, array $filter = null
        ,bool $isAll = null,?string $nameDateFilter = null,callable $callback = null,
                                  $tableName = null,$model = null): mixed
    {
        $filterFinal = $this->filterSearchAttributes($filter);

        $tableName = is_null($tableName) ? $queryBuilder->getQuery()->from : $tableName;

        $localLang = MyApp::Classes()->languageProcess->langLocal->id ?? "";

        $typesColumns = $this->getTypesColumns($tableName);

        foreach ($filterFinal as $key => $value){
            if (!is_null($value) && $this->checkKeyInModel($key,$tableName,$model)){
                $typesColumn = @$typesColumns[$key];
                if (in_array($typesColumn,self::DATATYPE_DATE)){
                    $value = MyApp::Classes()->stringProcess->DateFormat($value);
                }
                $queryBuilder = $this->querySearchMain($queryBuilder,$typesColumn,$model,$key,$value,$localLang);
            }
        }

        $queryBuilder = $this->filterSearchByDate($queryBuilder ,$nameDateFilter);

        $queryBuilder = $queryBuilder->orderBy("updated_at",$this->orderBy());

        if (!is_null($callback)){
            $queryBuilder = $callback($queryBuilder);
        }

        if ($isAll && !isset($this->request->countItems)){
            return $queryBuilder->get();
        }

        return $this->dataPaginate($queryBuilder);
    }

    /**
     * @param $queryBuilder
     * @return mixed
     * @author moner khalil
     */
    public function dataPaginate($queryBuilder): mixed
    {
        $tempCount = $this->countItemsPaginate();

        if ($tempCount === "all"){
            return $queryBuilder->get();
        }

        return $queryBuilder->paginate($tempCount);
    }

    /**
     * @return int|string
     * @author moner khalil
     */
    private function countItemsPaginate(): int|string
    {
        if ( isset($this->request->countItems) &&
            (
                (is_numeric($this->request->countItems) && $this->request->countItems >= 1)
                ||
                ($this->request->countItems == 'all')
            )
        ){
            return $this->request->countItems;
        }

        return env(MyApp::PAGINATE_NAME_SETTING,MyApp::DEFAULT_PAGES_Count);
    }

    /**
     * @param $query
     * @param $nameDate
     * @return mixed
     * @author moner khalil
     */
    private function filterSearchByDate($query ,$nameDate): mixed
    {
        $nameDate = is_null($nameDate) ? "updated_at" : $nameDate;
        $hasFilterDate = false;
        #Search by Year
        if (isset($this->request->year) && !is_null($this->request->year)) {
            $query = $query->whereYear($nameDate, "=", $this->request->year);
            $hasFilterDate = true;
        }
        #Search by start_date and end_date
        $start_date = $this->request->start_date;
        $end_date = $this->request->end_date;

        if (isset($start_date) || isset($end_date)) {
            $start_date = MyApp::Classes()->stringProcess->DateFormat($start_date);
            $end_date = MyApp::Classes()->stringProcess->DateFormat($end_date,true,true);
            if (is_bool($start_date) || is_bool($end_date)){
                $start_date = null;
                $end_date = null;
            }
            $query = $query->whereBetween($nameDate, [$start_date, $end_date]);
            $hasFilterDate = true;
        }

        if (!$hasFilterDate) {
            $query = $query->whereYear($nameDate, "=", Carbon::now()->year);
        }
        return $query;
    }

    /**
     * @param $filter
     * @return mixed
     * @author moner khalil
     */
    private function filterSearchAttributes($filter): mixed
    {
        $finalFilter = [];
        if (isset($filter)){
            $finalFilter = $filter;
        }
        if (isset($this->request->filter) && is_array($this->request->filter)){
            $finalFilter = array_merge($finalFilter,$this->request->filter);
        }
        if (isset($finalFilter['is_active'])){
            unset($finalFilter['is_active']);
        }
        return $finalFilter;
    }

    private function orderBy(){
        $orderRequest = $this->request->order;
        return in_array($orderRequest,["asc","desc"]) ? $orderRequest : "desc";
    }

    /**
     * @param $queryBuilder
     * @param $typesColumn
     * @param $model
     * @param $key
     * @param $value
     * @param $localLang
     * @return mixed
     */
    private function querySearchMain($queryBuilder, $typesColumn, $model, $key, $value, $localLang){
        if (in_array($typesColumn,self::DATATYPE_Time)) {
            $queryBuilder = $queryBuilder->where($key , "LIKE", $value."%");
        } elseif (in_array($typesColumn,self::DATATYPE_CHARS)){
            $queryBuilder = $queryBuilder->where($key , "LIKE", "%".$value."%");
        }else{
            $queryBuilder = $queryBuilder->where($key,$value);
        }
        return $queryBuilder;
    }

    /**
     * @param $table
     * @return mixed
     * @author moner khalil
     */
    private function getTypesColumns($table){
        return DB::table('INFORMATION_SCHEMA.COLUMNS')
            ->select(['DATA_TYPE','COLUMN_NAME'])
            ->where('TABLE_SCHEMA',env('DB_DATABASE'))
            ->where('TABLE_NAME', $table)
            ->pluck('DATA_TYPE','COLUMN_NAME')->toArray();
    }

    private function checkKeyInModel($key,$table,$model){
        if (is_null($model)){
            return Schema::hasColumn($table,$key);
        }else{
            $keys = array_merge($model->getFillable(),["id"]);
            return in_array($key,$keys);
        }
    }
}
