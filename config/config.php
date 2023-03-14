<?php

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;

/*
    این فایل کانفیگ هستش
    مواردی که لازمه تغییر بدید رو بالاش یه توضیح ریز 
    راجع بهش گفتم
    فقط دقت کنید که اگه یه کاراکتری رو اشتباه حذف کنید 
    کد کار نمیکنه. پس اگر سر در نمیارید راهنمایی بگیرید
    از سایر برنامه نویس ها
*/

return [
    'bot' => [
        #  توکن ربات
        'token' => 'TOKEN',

        # ادمین ربات - فقط یک ادمین میتونه باشه
        'admin_id' => 1816677960,
        
    ],

    /*-------------------------*/

    'db' => [
        # نام دیتبایس
        'database' => 'zchatbot',

        # نام کاربری یوزر
        'username' => 'pooria',

        # پسورد
        'password' => '123',

        # آدرس سرور، اگه نمیدونید چیه تغییرش ندید
        'host' => 'localhost',

        # موارد پایین رو اگر سر در نمیارید تغییر ندید
        'driver' => 'mysql',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_bin',
        'options' => [
            PDO::ATTR_PERSISTENT => true
        ]
    ],


    /*-------------------------*/

    'nutgram' => [
        'client' => [
            'http_errors' => false,

            # برای پروکسی هستش این
            # اگر سرور تون ایرانیه این تیکه کد رو
            # از حالت کامنت درش بیارید و آدرس بدید بهش
            // 'proxy' => '127.0.0.1:2081',
        ],
        'timeout' => 5,
        'cache' => new Psr16Cache(new FilesystemAdapter()),
    ],
];