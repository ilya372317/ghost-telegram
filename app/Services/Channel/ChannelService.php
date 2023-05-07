<?php

namespace App\Services\Channel;

use App\DTO\Api\Channel\UpdateChannelDTO;
use App\Models\Channel;
use Illuminate\Pagination\LengthAwarePaginator;

interface ChannelService
{
    /**
     * @return LengthAwarePaginator
     */
    public function getChannelPaginator(): LengthAwarePaginator;

    /**
     * @param int $channelId
     * @return Channel
     */
    public function getChannel(int $channelId): Channel;

    /**
     * @param int $channelId
     * @param UpdateChannelDTO $updateChannelDTO
     * @return Channel
     */
    public function updateChannel(int $channelId, UpdateChannelDTO $updateChannelDTO): Channel;

    /**
     * @param array<int> $channelsIds
     * @return void
     */
    public function deleteChannels(array $channelsIds): void;
}
