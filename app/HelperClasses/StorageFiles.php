<?php

namespace App\HelperClasses;

use App\Exceptions\MainException;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StorageFiles
{
    private const DISK = "public";
    public const EX_IMG = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
    public const Ex_FILE = ['pdf','xlsx','csv','docx'];
    public const FOLDER_IMAGES = "images";
    public const FOLDER_FILES = "files";

    #defaulImagePath
    public const FOLDER_IMG_RESIZE = "resizeFolderImg";

    public const FOLDER_IMG_REAL = "realFolderImg";
    #_Name File Or Image in DataBase
    public const NAME_File = "pdf";
    public const NAME_IMG = "png";
    #_Byte size
    public const Max_SIZE_IMG = 256000;
    public const Max_SIZE_FILE = 10000000;
    private const FOLDER_STORAGE = "storage";

    /**
     * @param $file
     * @param string $pathDir
     * @param string|null $disk
     * @param bool $isResize
     * @return bool|string
     * @throws MainException
     * @author moner khalil
     */
    public function Upload($file, string $pathDir = "", string $disk = null,bool $isResize = true): bool|string
    {
        $ext = $file->getClientOriginalExtension();
        $file_base_name = str_replace('.' . $file->getClientOriginalExtension(), '', $file->getClientOriginalName());
        $fileNameFinal = strtolower(time() . Str::random(5) . '-' . Str::slug($file_base_name)) . '.' . $file->getClientOriginalExtension();
        if (in_array($ext, $this->getExFiles(true))) {
            $path = Storage::disk(is_null($disk) ? self::DISK : $disk)
                ->putFileAs($pathDir . "/" . self::FOLDER_FILES, $file, $fileNameFinal);
            if (is_string($path)){
                return self::FOLDER_STORAGE . "/" . $path;
            }
        }
        if (in_array($ext, $this->getExImages(true))) {
            $path = $this->imageUpload($file,$pathDir,$disk,$fileNameFinal,$isResize);
            if (is_string($path)){
                return self::FOLDER_STORAGE . "/" . $path;
            }
        }
        throw new MainException("you cant upload current file_ -OR- fix in upload file....");
    }

    /**
     * @param $file
     * @param $pathDir
     * @param $disk
     * @param $fileNameFinal
     * @param $isResize
     * @return false|string
     */
    private function imageUpload($file, $pathDir, $disk, $fileNameFinal, $isResize){
        $disk = is_null($disk) ? self::DISK : $disk;
        $pathReal = Storage::disk($disk)
            ->putFileAs($pathDir . "/" . self::FOLDER_IMAGES . "/" . self::FOLDER_IMG_REAL, $file, $fileNameFinal);
        if ($isResize){
            $resized_thumb = Image::make($file)->resize(250, 250)->stream();
            $pathResize = $pathDir . "/" . self::FOLDER_IMAGES . "/" . self::FOLDER_IMG_RESIZE . "/" . $fileNameFinal;
            Storage::disk($disk)
                ->put($pathResize, $resized_thumb->__toString());
            return $pathResize;
        }
        return $pathReal;
    }

    /**
     * @param string $paths
     * @param string|null $disk
     * @return bool
     * @author moner khalil
     */
    public function deleteFile(string $path, string $disk = null): bool
    {
        $disk = is_null($disk) ? self::DISK : $disk;
        $pathImgReal = str_replace(
            [
                \App\HelperClasses\StorageFiles::FOLDER_IMG_RESIZE,
            ],
            [
                \App\HelperClasses\StorageFiles::FOLDER_IMG_REAL,
            ],
            $path
        );
        Storage::disk($disk)->delete($pathImgReal);
        return Storage::disk($disk)->delete($path);
    }

    /**
     * @param string $path
     * @param string|null $disk
     * @return BinaryFileResponse
     * @throws Exception
     * @author moner khalil
     */
    public function downloadFile(string $path, string $disk = null): BinaryFileResponse
    {
        $path = self::getReplacePathToRealExist($path);
        $path = ltrim($path, 'storage/');
        $path = Storage::disk(is_null($disk) ? self::DISK : $disk)->path($path);
        $file = file_exists($path) ? $path : null;
        if (!is_null($file)) {
            $file = response()->download($file);
            ob_end_clean();
            return $file;
        }
        throw new MainException("the path file {$path} is not exists");
    }


    /**
     * @param string $path
     * @return array|string
     * @author moner khalil
     */
    public static function getReplacePathToRealExist(string $path): array|string{
        return str_replace(
            [
                \App\HelperClasses\StorageFiles::FOLDER_IMG_RESIZE,
            ],
            [
                \App\HelperClasses\StorageFiles::FOLDER_IMG_REAL,
            ],
            $path
        );
    }

    public function getSizeFiles(){
        return env("SIZE_FILES_STORAGE",self::Max_SIZE_FILE);
    }

    public function getExFiles($is_array = false){
        $ext = env("Ex_FILE",implode(",",self::Ex_FILE));
        return !$is_array ? $ext : explode(",",$ext);
    }

    public function getSizeImages(){
        return env("SIZE_IMAGES_STORAGE",self::Max_SIZE_IMG);
    }

    public function getExImages($is_array = false){
        $ext = env("EX_IMG",implode(",",self::EX_IMG));
        return !$is_array ? $ext : explode(",",$ext);
    }

}
