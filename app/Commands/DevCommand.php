<?php

namespace poorbash\ZChatBot\App\Commands;

use SergiX44\Nutgram\Nutgram;

class DevCommand
{
    public function __invoke(Nutgram $bot)
    {
        # لطفا اسم توسعه دهنده رو حذف نکنید جیگرا
        $txt = <<<TXT
        Developer: Pooria Bashiri
        Channel: @poorbash
        Github: https://github.com/poorbash
        TXT;
        $bot->sendMessage($txt);
    }
}