<?php

namespace App\Repository\Channel;

use App\Models\Channel;
use Illuminate\Pagination\LengthAwarePaginator;

interface ChannelRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function getChannelsPaginator(): LengthAwarePaginator;

    /**
     * @param int $id
     * @return Channel
     */
    public function getChannelById(int $id): Channel;
}
