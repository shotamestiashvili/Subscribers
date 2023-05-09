<?php

namespace App\Http\Controllers;

use Domain\Subscriber\Jobs\ImportSubscribersJob;
use Illuminate\Support\Facades\Request;
use \Symfony\Component\HttpFoundation\Response;


class ImportSubscribersController
{
    public function __invoke(Request $request): Response
    {
        ImportSubscribersJob::dispatch(
            storage_path('subscribers/subscribers.csv'),
            $request->user(),
        );

        return response('', Response::HTTP_ACCEPTED);
    }
}
