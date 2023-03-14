<?php

/*-------------------------*/

use Illuminate\Database\Capsule\Manager as Capsule;
use poorbash\ZChatBot\App\Commands\DeleteMessageCommand;
use poorbash\ZChatBot\App\Commands\DevCommand;
use poorbash\ZChatBot\App\Commands\StartCommand;
use poorbash\ZChatBot\App\Handlers\MessageHandler;
use poorbash\ZChatBot\App\Middlewares\CollectChatMiddleware;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\RunningMode\Webhook;
use SergiX44\Nutgram\Telegram\Exceptions\TelegramException;

/*-------------------------*/

ini_set('error_log', __DIR__.'/logs/'.basename(__FILE__).'.log');

/*-------------------------*/

date_default_timezone_set('Asia/Tehran');

/*-------------------------*/

require __DIR__.'/vendor/autoload.php';
$strings = require __DIR__.'/config/strings.php';
$config = require __DIR__.'/config/config.php';
require __DIR__.'/config/funcs.php';

/*-------------------------*/

$capsule = new Capsule();
$capsule->addConnection(config('db'));
$capsule->setAsGlobal();
$capsule->bootEloquent();

/*-------------------------*/

$bot = new Nutgram(config('bot.token'), config('nutgram'));
$bot->setRunningMode(Webhook::class);

/*-------------------------*/

$bot->middleware([
    CollectChatMiddleware::class,
]);

/*-------------------------*/

# دستور استارت
$bot->onCommand('start', StartCommand::class);

# دستور دو برای دریافت اطلاعات توسعه دهنده
$bot->onCommand('dev', DevCommand::class);

/*-------------------------*/

# ارسال پیام کاربرا به ادمین وبالعکس
$bot->onMessage(MessageHandler::class);

/*-------------------------*/

# حذف پیام
$bot->onCallbackQueryData('msg/del/([0-9]+)', DeleteMessageCommand::class);

/*-------------------------*/

$bot->onException(fn (Nutgram $bot) => $bot->sendMessage('common.err.unknown_error'));

/*-------------------------*/

$bot->onApiError(fn (Nutgram $bot, TelegramException $e) => throw $e);

/*-------------------------*/

$bot->run();

/*-------------------------*/

/**
 * 
 * @version 1.0.0
 * @author Pooria Bashiri <po.pooria@gmail.com>
 * @link https://github.com/poorbash/ZChatBot
 * @link https://t.me/poorbash
 */
