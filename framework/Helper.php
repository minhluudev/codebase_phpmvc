<?php

namespace Framework;

class Helper {
    public static function env($name, $default = '') {
        return $_ENV[$name] ?? $default;
    }

    public static function config($name) {
        $config = [
            'db' => include_once self::basePath('/config/database.php')
        ];

        return $config[$name] ?? null;
    }

    public static function basePath(string $path = ''): string {
        return dirname(__DIR__).$path;
    }

    public static function convertToSnakeCaseAndPlural($input): string {
        $snake_case = preg_replace('/(?<!^)[A-Z]/', '_$0', $input);
        $snake_case = strtolower($snake_case);

        if (str_ends_with($snake_case, 'y')) {
            $snake_case = substr($snake_case, 0, -1).'ies';
        } else if (!str_ends_with($snake_case, 's')) {
            $snake_case .= 's';
        }

        return $snake_case;
    }
}
