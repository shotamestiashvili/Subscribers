<?php

namespace App\Http\Controllers\Mail\Broadcast;

use Domain\Mail\Mails\EchoMail;
use Domain\Mail\Models\Broadcast\Broadcast;
use Inertia\Inertia;
use Inertia\Response;

class PreviewBroadcastController
{
    public function __invoke(Broadcast $broadcast): Response
    {
        return Inertia::render(
          'Broadcast/Preview', [
              'model' => new PreviewBroadcastViewModel(
                  new EchoMail($broadcast)
              )
            ]
        );
    }
}
