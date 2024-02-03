<?php

namespace App\HelperClasses;


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
