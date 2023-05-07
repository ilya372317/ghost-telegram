<?php

namespace App\Http\Controllers\Channel;

use App\DTO\Api\Channel\CreateChannelDTO;
use App\DTO\Api\Channel\UpdateChannelDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Channel\CreateChannelRequest;
use App\Http\Requests\Channel\UpdateChannelRequest;
use App\Models\Channel;
use App\Services\Channel\ChannelService;
use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ChannelController
 * @pakege App\Http\Controllers\Channel
 *
 * @author Otinov Ilya
 */
class ChannelController extends Controller
{
    public function __construct(
        private readonly ChannelService $channelService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): LengthAwarePaginator
    {
        return $this->channelService->getChannelPaginator();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateChannelRequest $request): Channel
    {
        $createChannelDTO = CreateChannelDTO::createFromRequest($request);
        return $this->channelService->createChannel($createChannelDTO);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChannelRequest $request, string $id): Channel
    {
        $updateChannelDTO = UpdateChannelDTO::createFromRequest($request);
        return $this->channelService->updateChannel($id, $updateChannelDTO);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Application|Response|FoundationApplication|ResponseFactory
    {
        $this->channelService->deleteChannels([$id]);
        return response(status: 204);
    }
}
