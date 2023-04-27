<?php

namespace App\Services\Ghost;

use App\DTO\Ghost\Post\GhostPost;
use App\DTO\Telegram\TelegramChannel\TelegramChannel;
use App\DTO\Telegram\TelegramMessage\TelegramMessage;
use App\DTO\Telegram\TelegramUser\TelegramUser;
use App\Exception\FailedToConvertException;
use App\Models\Channel;
use App\Utils\JWT\JwtParser;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Class GhostClientService
 * @pakege App\Services\Ghost
 *
 * @author Otinov Ilya
 */
class GhostClientService implements GhostClient
{
    private const MIN_POST_LENGTH = 1000;

    private const POST_TITLE_LENGTH = 40;

    /**
     * @param GhostPost $postContent
     * @return void
     * @throws FailedToConvertException
     */
    public function createNewPost(GhostPost $postContent): void
    {
        /** @var Response $response */
        $jwtToken = JwtParser::parseToken();
        $response = Http::ghost()->withHeaders(['Authorization' => " Ghost $jwtToken"])
            ->withUrlParameters(['source' => 'html'])->post('/posts?source={source}', [
            'posts' => [
                [
                    'title' => mb_convert_encoding($postContent->title, 'UTF-8', 'UTF-8'),
                    'status' => 'draft',
                    'authors' => [
                        [
                            'email' => 'otinoff@gmail.com',
                        ]
                    ],
                    'html' => '<p>' . str_replace("\n", '<br>', $postContent->content) . '</p>',
                    'tags' => [config('ghost.tag_id')]
                ]
            ]
        ]);

        if ($response->failed()) {
            throw new FailedToConvertException("Failed to send post " . $response);
        }
    }

    public function createPostFromTelegramUserMessage(
        TelegramUser    $telegramUser,
        TelegramMessage $telegramMessage
    ): void
    {
        $content = $telegramMessage->text;
        $title = substr($content, 0, 30) . '...';

        $postContent = new GhostPost(content: $content, title: $title);

        $this->createNewPost($postContent);
    }

    public function createPostFromTelegramChannelMessage(TelegramChannel $channel, TelegramMessage $message): void
    {
        $ghostPost = $this->makeGhostPostFromChannelMessage($channel, $message);

        if (is_null($ghostPost)) {
            return;
        }

        $this->createNewPost($ghostPost);
    }

    private function makeGhostPostFromChannelMessage(TelegramChannel $channel, TelegramMessage $message): ?GhostPost
    {
        $content = $this->addAuthorLinkToContent($message->text, $channel);
        if (!$this->contentIsValid($content)) {
            return null;
        }

        if (!$this->channelIsValid($channel)) {
            return null;
        }

        $title = $this->getTitleFromChannelMessage($content);

        return new GhostPost($content, $title);
    }

    private function channelIsValid(TelegramChannel $channel): bool
    {
        $myChannels = Channel::all()->pluck('username')->toArray();

        return in_array($channel->username, $myChannels);
    }

    private function getTitleFromChannelMessage(string $content): string
    {
        return substr($content, 0, self::POST_TITLE_LENGTH) . '...';
    }

    private function contentIsValid(string $content): bool
    {
        return strlen(trim($content)) > self::MIN_POST_LENGTH;
    }

    private function addAuthorLinkToContent(string $content, TelegramChannel $channel): string
    {
        return $content . "\n\n" . "<b>" . 'Источник: ' . "</b>" . "<a href='$channel->inviteLink'>$channel->username</a>";
    }
}
