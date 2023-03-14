<?php

namespace poorbash\ZChatBot\App\Middlewares;

use poorbash\ZChatBot\App\Models\User;
use SergiX44\Nutgram\Nutgram;

class CollectChatMiddleware
{
    public function __invoke(Nutgram $bot, $next)
    {
        $user = $bot->user();
        $user = User::updateOrCreate(['user_id' => $bot->userId()], [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'username' => $user->username,
        ]);
        $bot->setData('user', $user);
        $next($bot);
    }
}