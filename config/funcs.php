<?php

/*
    فایل مربوط به توابع پرکاربرد در پروژه
    توابع خودتون رو که خیلی استفاده میکنید در پروژه
    میتونید اینجا اضافه کنید
*/

use Illuminate\Support\Arr;

/*-------------------------*/

function message(string|array $path, array $values = [], string $delimiter = "\n\n"): string|array
{
    if (is_array($path)) {
        $output = '';
        foreach ($path as $k => $v) {
            $output .= (is_array($v) ? message($k, $v) : message($v)) . $delimiter;
        }
        return $output;
    }
    $output = Arr::get($GLOBALS['strings'], $path);
    if (is_string($output)) {
        return strtr($output, array_merge($values, [
            '    ' => '',
        ]));
    }
    return $output;
}

/*-------------------------*/

function config(string $path): mixed
{
    return Arr::get($GLOBALS['config'], $path);
}
