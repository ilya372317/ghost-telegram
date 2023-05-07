<?php

namespace App\Repository\Channel;

use App\Exception\Elequent\ModelNotFoundException;
use App\Models\Channel;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class DatabaseChannelRepository
 * @pakege App\Repository\Channel
 *
 * @author Otinov Ilya
 */
class DatabaseChannelRepository implements ChannelRepository
{
    private static array $channelsColumns = [
        'id',
        'username',
        'updated_at',
        'created_at'
    ];

    private const CHANNEL_PER_PAGE = 100;

    /**
     * @inheritDoc
     */
    public function getChannelsPaginator(): LengthAwarePaginator
    {
        return Channel::select(columns: self::$channelsColumns)
            ->paginate(perPage: self::CHANNEL_PER_PAGE);
    }

    /**
     * @inheritDoc
     */
    public function getChannelById(int $id): Channel
    {
        $channel = Channel::select(self::$channelsColumns)
            ->find($id);

        if (is_null($channel)) {
            throw new ModelNotFoundException($id);
        }

        return $channel;
    }
}
