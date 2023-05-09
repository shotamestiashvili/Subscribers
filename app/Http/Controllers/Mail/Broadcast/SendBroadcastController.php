<?php

namespace App\Http\Controllers\Mail\Broadcast;

use Domain\Mail\Jobs\SendBroadcastJob;
use Domain\Mail\Models\Broadcast\Broadcast;
use Symfony\Component\HttpFoundation\Response;

class SendBroadcastController
{
    public function __invoke(Broadcast $broadcast): Response
    {
        SendBroadcastJob::dispatch($broadcast);
        return response('', Response::HTTP_ACCEPTED);
    }
}
