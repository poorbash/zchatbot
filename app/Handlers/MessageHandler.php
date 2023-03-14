<?php

namespace poorbash\ZChatBot\App\Handlers;

use poorbash\ZChatBot\App\Models\Message;
use poorbash\ZChatBot\App\Models\User;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Chat\ChatMemberMember;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;
use SergiX44\Nutgram\Telegram\Types\Keyboard\KeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\ReplyKeyboardMarkup;

class MessageHandler
{
    public function __invoke(Nutgram $bot)
    {
        # از اونجای یکه این بخش کمی گیج کننده ست کامت گذاری میکنم که راحت تر باشه درکش
        # این بخش برای ارسال پیام کاربرا به ادمین و بالعکس هست

        // --------------------------------------------

        # اطلاعات کاربر فعلی که داره پیام میفرسته به ربات
        $user = $bot->getData('user');

        # جزئیات پیام ریپلای شده در آپدیتی که تلگرام میفرسته رو میگیریم
        $repliedMessage = $bot->message()?->reply_to_message;

        # اگر روی پیامی ریپلای شده بود
        if ($repliedMessage) {

            # اینجا اطلاعات اون پیام ریپلای شده رو میگیریم
            # تا فرستنده و گیرنده پیام مشخص باشه
            $message = Message::where(
                'destination_message_id',
                $repliedMessage?->message_id,
            )->with(['sender', 'receiver'])->first();

            # فرستنده پیام، قراره پاسخ پیامشو بگیره، پس اینجا فرستنده خودش میشه گیرنده
            $receiver = $message?->sender;

            # گیرنده که  کاربر فعلی هست، حالا خودش میشه فرستنده
            $sender = $message?->receiver; // 

        } else { # اگر روی پیامی ریپلای نشده بود

            # و در عین حال، کاربر فعلی ادمین ربات بود بهش
            # خطا نشون میدیم و میگیم داش داری اشتب میزنی
            # لطفا ریپلای کن رو پیام یکی از کاربرا
            if ($user->isAdmin()) { 
                return $bot->sendMessage(message('common.err.reply_on_message'));
            }
            // اینجا اگر کاربر ادمین باشه اصلا این بخش از کد اجرا نمیشه

            # درسته این بخش از کد برای ادمین اجرا نمیشه
            # ولی برای کاربرا که اجرا میشه
            # پس چون کاربر فعلی یک کاربر معمولیه که داره به ربات پیام میده
            # گیرنده ی پیام باید ادمین باشه، پس اطلاعات ادمین رو از دیتابیس میگیریم
            $receiver = User::where('user_id', config('bot.admin_id'))->first();

            # اینجا صرفا اطلاعات کاربر فعلی که فرستنده هم هست رو میریزیم تو یه متغیر دیگه
            $sender = $user;
        }

        # مسیج آیدی پیام شو ذخیره میکنیم
        $messageId = $bot->messageId();

        # و در نهایت به تابع میدیم که فوروارد کنه به کاربر مورد نظر
        $response = $bot->forwardMessage($receiver->user_id, $sender->user_id, $messageId);

        # حالا اینجا اطلاعت این پیام هارو در دیتبایس ذخیره میکنیم که داشته باشیم
        $message = Message::create([
            'sender_id' => $sender->id, // ایدی فرستنده پیام
            'receiver_id' => $receiver->id, // آیدی گیرنده پیام
            'origin_message_id' => $messageId, // مسیج آیدی مبدا
            'destination_message_id' => $response->message_id, // مسیج آیدی مقصد
        ]);

        # و در نهایت به کاربر فعلی که فرستنده ست میگیم پیامت ارسال شد
        $bot->sendMessage(message('common.msg.message_sent'), [
            'reply_to_message_id' => $messageId,
            'reply_markup' => InlineKeyboardMarkup::make()->addRow(
                InlineKeyboardButton::make(
                    message('common.btn.delete'),
                    callback_data: "msg/del/{$message->id}"
                ),
            )
        ]);

        # ایزی ایزی تامامم تامام
    }
}