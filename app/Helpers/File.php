<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class File
{
    private static $source_path; // 원본 패스
    private static $target_path; // 완료 된 패스
    private static $local_folder;

    public static function isDir($path) {
        return is_dir(sprintf("%s%s", storage_path('app/public'), $path));
    }

    public static function makeDir($path) {
        return Storage::disk('public')->makeDirectory($path);
    }

    public static function getFileSize($path) {
        return Storage::disk('public')->size($path);
    }

    public static function upload($files, $folder="", $filename="") {
        $name = $files->getClientOriginalName();
        // 맥에서 업로드 시, 한글 깨짐을 방지하기 위한 메소드
        if (!\Normalizer::isNormalized($name)) {
            $name = \Normalizer::normalize($name);
        }

        $ext = $files->getClientOriginalExtension();

        if (empty($filename)) {
            $filename = sprintf("%s_%s", date('Ymd'), md5(time().$name));
            $folder = sprintf("%s/%s",
                $folder,
                date('Ymd')
            );

            if (!self::isDir($folder)) {
                if (!self::makeDir($folder)) {
                    return response()->json(array("status"=>"err1-2","msg"=>"Make Dir Err"));
                }
            }

            $upload_path = sprintf("%s/%s",
                storage_path('app/public'),
                $folder
            );

        } else {
            $upload_path = sprintf("%s/%s",
                storage_path('app/public'),
                $folder
            );
        }

        $resFilename = sprintf("%s.%s", $filename, $ext);
        $resFilepath = sprintf("/%s/%s", $folder, $resFilename);
        if (!$files->move($upload_path, $resFilename))
            return false;
        return array(
            "path"=>$resFilepath,
            "name"=>$name,
            "size"=>self::getFileSize($resFilepath),
            "ext"=>$ext
        );
    }
}
