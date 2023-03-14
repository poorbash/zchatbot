<?php

/*
    این فایل مروبط به پیغام های داخل رباته
    میتونید مقادریش رو تغییر بدید
    فقط حواستون باشه خرابکاری نکنید
    :)
*/

return [
    'common' => [
        'btn' => [
            'delete' => '📛 حذف پیام',
        ],
        'err' => [
            'unknown_error' => 'خطای ناشناخته ای رخ داد!',
            'reply_on_message' => 'لطفا برای پاسخ به کاربران، بر روی پیام آنها ریپلای بزنید',
        ],
        'msg' => [
            'message_sent' => 'پیام ارسال شد',
            'message_not_found' => 'پیامی پیدا نشد! به نظر میرسد قبلا حذف شده است',
            'message_deleted' => 'پیام حذف شد',
        ],
    ],

    'start' => [
        'dsp' => <<<TXT
            به پیامرسان خودت خوشومدی

            کاربرا که ربات رو استارت کنن مستقیم میتونن در هر زمانی پیام ارسال کنن
            شما به عنوان ادمین میتونی با ریپلای کردن بهشون جواب بدی
            از اونجایی که چند ادمینه بودن این ربات دنگ و فنگ زیاد داره ... صرفا یه ادمین که خودت باشی قابل تعیینه.

            میتونی این متن رو از مسیر زیر تو سورس تغییر بدی:
            config/strings.php
            
            میتونی کدهارو تغییر بدی و شخصی سازی ش کنی و سورس تغییر یافته رو بفروشی، فقط جان عزیزت به کاربرات پشتیبانی ارائه بده :)
            
            این سورس کد به صورت رایگان و با اهداف آموزشی منتشر شده . مسئولیت نحوه ی استفاده ی شما عزیزان به دوش خودتونه.

            اگه دوست داشتی عضو کانالم شو حتما:
            @poorbash

            امیدوارم استفاده ی درستی ازش بکنی 😉
            عشق منی ❤️
        TXT,
    ],
];