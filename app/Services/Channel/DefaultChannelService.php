<?php

namespace App\Services\Channel;

use App\DTO\Api\Channel\UpdateChannelDTO;
use App\Models\Channel;
use App\Repository\Channel\ChannelRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class DefaultChannelService
 * @pakege App\Services\Channel
 *
 * @author Otinov Ilya
 */
class DefaultChannelService implements ChannelService
{
    public function __construct(
        private ChannelRepository $channelRepository
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getChannelPaginator(): LengthAwarePaginator
    {
        return $this->channelRepository->getChannelsPaginator();
    }

    /**
     * @inheritDoc
     */
    public function getChannel(int $channelId): Channel
    {
        return $this->channelRepository->getChannelById($channelId);
    }

    /**
     * @inheritDoc
     */
    public function updateChannel(int $channelId, UpdateChannelDTO $updateChannelDTO): Channel
    {
        $channel = $this->channelRepository->getChannelById($channelId);
        $channel->update($updateChannelDTO->toArray());
        return $channel;
    }

    /**
     * @inheritDoc
     */
    public function deleteChannels(array $channelsIds): void
    {
        Channel::destroy($channelsIds);
    }
}
