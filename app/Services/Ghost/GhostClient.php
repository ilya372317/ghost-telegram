<?php

namespace App\Services\Ghost;

use App\DTO\Ghost\Post\GhostPost;
use App\DTO\Telegram\TelegramChannel\TelegramChannel;
use App\DTO\Telegram\TelegramMessage\TelegramMessage;
use App\DTO\Telegram\TelegramUser\TelegramUser;

interface GhostClient
{
    public function createNewPost(GhostPost $postContent): void;

    public function createPostFromTelegramUserMessage(
        TelegramUser    $telegramUser,
        TelegramMessage $telegramMessage
    ): void;

    public function createPostFromTelegramChannelMessage(
        TelegramChannel $channel,
        TelegramMessage $message
    ): void;

}
