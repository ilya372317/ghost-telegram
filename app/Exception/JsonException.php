<?php

namespace App\Exception;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use RuntimeException;
use \Illuminate\Contracts\Foundation\Application as FoundationApplication;

abstract class JsonException extends RuntimeException
{
    /**
     * @param Request $request
     * @return FoundationApplication|ResponseFactory|Application|Response
     */
    public function render(Request $request): Application|Response|FoundationApplication|ResponseFactory
    {
        return response([
            'error' => $this->getErrorTitle(),
            'message' => $this->getErrorText(),
            'stackTrace' => $this->getTraceAsString(),
        ]);
    }

    abstract protected function getErrorTitle(): string;

    abstract protected function getErrorText(): string;
}
