<?php

namespace App\EventHandler;

use App\DTO\Telegram\TelegramChannel\TelegramMessageConverter;
use App\DTO\Telegram\TelegramMessage\TelegramFromUserMessageConverter;
use App\DTO\Telegram\TelegramUser\TelegramUser;
use App\DTO\Telegram\TelegramUser\TelegramUserConverter;
use App\Exception\FailedToConvertException;
use App\Services\Ghost\GhostClient;
use App\Services\Ghost\GhostClientService;
use danog\MadelineProto\Db\DbArray;
use danog\MadelineProto\EventHandler;

class TelegramEventHandler extends EventHandler
{
    /**
     * @var int|string Username or ID of bot admin
     */
    const ADMIN = "ilyaotinov"; // !!! Change this to your username !!!

    /**
     * List of properties automatically stored in database (MySQL, Postgres, redis or memory).
     *
     * Note that **all** properties will be stored in the database, regardless of whether they're specified here.
     * The only difference is that properties *not* specified in this array will also always have a full copy in RAM.
     *
     * Also, properties specified in this array are NOT thread-safe, meaning you should also use a synchronization primitive
     * from https://github.com/amphp/sync/ to use them in a thread-safe manner.
     *
     * @see https://docs.madelineproto.xyz/docs/DATABASE.html
     */
    protected static array $dbProperties = [
        'dataStoredOnDb' => 'array',
    ];

    /**
     * @var DbArray<array-key, array>
     */
    protected DbArray $dataStoredOnDb;
    /**
     * This property is also saved in the db, but it's also always kept in memory, unlike $dataStoredInDb which is exclusively stored in the db.
     * @var array<int, bool>
     */
    protected array $notifiedChats = [];

    private int $adminId;

    /**
     * Get peer(s) where to report errors.
     *
     * @return int|string|array
     */
    public function getReportPeers()
    {
        return [self::ADMIN];
    }

    /**
     * Initialization logic.
     */
    public function onStart(): void
    {
        $this->logger("The bot was started!");
        $this->logger($this->getFullInfo('ilyaotinov'));
        $adminId = $this->getFullInfo('ilyaotinov')['User']['id'];
        $this->adminId = $adminId;
    }

    /**
     * @param array $update
     * @return void
     */
    public function onAny(array $update): void
    {
        $this->logger("any is work!");
    }

    public function onUpdateNewMessage(array $message): void
    {
        /** @var GhostClient $clientService */
        $clientService = app(GhostClientService::class);
        try {
            $this->logger($message);
            $fromUser = TelegramUserConverter::convert($this->getFullInfo($message['message']['from_id']));
            $message = TelegramFromUserMessageConverter::convert($message['message']);
            $clientService->createPostFromTelegramUserMessage($fromUser, $message);
        } catch (FailedToConvertException $e) {
            $this->logger($e->getMessage());
        }

    }

    public function onUpdateNewChannelMessage(array $update): void
    {
        /** @var GhostClient $clientService */
        $clientService = app(GhostClientService::class);
        try {
            $rawChannel = $this->getFullInfo($update['message']['peer_id']);
            $this->logger($rawChannel);
            $channel = TelegramMessageConverter::convert($rawChannel);
            $message = TelegramFromUserMessageConverter::convert($update['message']);
            $clientService->createPostFromTelegramChannelMessage($channel, $message);
        } catch (FailedToConvertException $e) {
            $this->logger($e->getMessage());
        }
    }
}
