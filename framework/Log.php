<?php

namespace Framework;

class Log {
    public static function info($message): void {
        $content = "[".date('Y-m-d H:i:s')."] INFO: ".json_encode($message).PHP_EOL;
        self::fileWrite($content);
    }

    private static function fileWrite($content): void {
        $fileName = date('Y-m-d').'.log';
        $filePath = Helper::basePath("/logs/$fileName");

        if (!file_exists($filePath)) {
            $file = fopen($filePath, 'w');
            if ($file) {
                fwrite($file, $content);
                fclose($file);
            }
        } else {
            $file = fopen($filePath, 'a');
            if ($file) {
                fwrite($file, $content);
                fclose($file);
            }
        }
    }

    public static function warning($message): void {
        $content = "[".date('Y-m-d H:i:s')."] WARNING: ".json_encode($message).PHP_EOL;
        self::fileWrite($content);
    }

    public static function error($message): void {
        $content = "[".date('Y-m-d H:i:s')."] ERROR: ".json_encode($message).PHP_EOL;
        self::fileWrite($content);
    }
}
