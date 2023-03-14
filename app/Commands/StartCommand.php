<?php

namespace poorbash\ZChatBot\App\Commands;

use SergiX44\Nutgram\Nutgram;

class StartCommand
{
    public function __invoke(Nutgram $bot)
    {
        $bot->sendMessage(message('start.dsp'));
    }
}