<?php

namespace App\Http\Controllers\Channel;

use App\Http\Controllers\Controller;
use App\Services\Channel\ChannelService;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
