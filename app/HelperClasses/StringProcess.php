<?php

namespace App\HelperClasses;

use App\Models\Category;
use DateTime;
use Illuminate\Support\Carbon;

class StringProcess
{
    /**
     * @param string $str
     * @return string
     * @author moner khalil
     */
    public function camelCase(string $str): string
    {
        $i = array("-", "_");
        $str = preg_replace('/([a-z])([A-Z])/', "\\1 \\2", $str);
        $str = preg_replace('@[^a-zA-Z0-9\-_ ]+@', '', $str);
        $str = str_replace($i, ' ', $str);
        $str = str_replace(' ', '', ucwords(strtolower($str)));
        $str = strtolower(substr($str, 0, 1)) . substr($str, 1);
        return ucfirst($str);
    }

    /**
     * @param string $title
     * @param $model
     * @param string $column
     * @return string
     * @author moner khalil
     */
    function uniqueSlug(string $title, $model, string $column = 'slug',$idIgnore = null): string
    {

        $slug = $title;

        $string = mb_strtolower($slug, "UTF-8");;
        $string = preg_replace("/[\/.]/", " ", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $slug = preg_replace("/[\s_]/", '-', $string);

        //get unique slug...
        $nSlug = $slug;
        $i = 0;

        if (!is_null($idIgnore)){
            $model = $model->whereNot("id",$idIgnore);
        }
        $model = $model->select([$column])->get();
        while (($model->where($column, '=', $nSlug)->count()) > 0) {
            $nSlug = $slug . '-' . ++$i;
        }

        return ($i > 0) ? substr($nSlug, 0, strlen($slug)) . '-' . $i : $slug;
    }

    /**
     * @description Check String is Date and Convert to YYYY-MM-DD
     * @param string $inputString
     * @param bool $withTimeStamp
     * @param bool $endDay
     * @return false|string
     * @author moner khalil
     */
    public function DateFormat(string $inputString,bool $withTimeStamp = false , bool $endDay = false){
        $formats = [
            'Y-m-d',
            'd-m-Y',
            'd/m/Y',
            'm/d/Y',
        ];
        $isValid = false;
        foreach ($formats as $format) {
            $date = DateTime::createFromFormat($format, $inputString);
            if ($date !== false && $date->format($format) === $inputString) {
                $isValid = true;
                $inputString = Carbon::createFromFormat($format, $inputString);
                if ($withTimeStamp){
                    $inputString = $endDay ? $inputString->endOfHour() : $inputString->endOfDay();
                }
                $finalFormat = $withTimeStamp ? 'Y-m-d H:i:s' : 'Y-m-d';
                $inputString = $inputString->format($finalFormat);
                break;
            }
        }
        return $isValid ? $inputString : false;
    }

    /**
     * @description code Generate Unique in table
     * @param $firstCode
     * @param $queryObj
     * @param $columnCode
     * @return string
     * @author moner khalil
     */
    public function codeGenerateUnique($firstCode, $queryObj, $columnCode){
        $idMax = $queryObj->max("id") + 1;
        $code = $firstCode . "-" . $idMax;
        return $this->uniqueSlug($code,$queryObj,$columnCode);
    }
}
