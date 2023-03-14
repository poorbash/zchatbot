<?php

namespace poorbash\ZChatBot\App\Commands;

use poorbash\ZChatBot\App\Models\Message;
use SergiX44\Nutgram\Nutgram;

class DeleteMessageCommand
{
    public function __invoke(Nutgram $bot, $messageId)
    {
        $message = Message::with(['receiver'])->find($messageId);
        if (!$message) {
            return $bot->answerCallbackQuery([
                'text' => message('common.err.message_not_found'),
                'show_alert' => true,
            ]);
        }
        $bot->deleteMessage($message->receiver->user_id, $message->destination_message_id);
        $message->delete();
        $bot->editMessageText(message('common.msg.message_deleted'));
    }
}