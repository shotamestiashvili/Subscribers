<?php

namespace App\Http\Controllers\Mail\Broadcast;

use Domain\Mail\DataTransferObjects\Broadcast\BroadcastData;
use Domain\Mail\Models\Broadcast\Broadcast;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class BroadcastController
{
    public function index(): Response
    {
        return Inertia::render('Broadcast/List', [
            'model' => new GetBroadcastsViewModel(),
        ]);
    }

    public function store(
        BroadcastData $data,
        Request       $request,
    ): RedirectResponse
    {
        UpsertBroadcastAction::execute($data, $request->user());

        return Redirect::route('broadcast.index');
    }

    public function update(
        BroadcastData $data,
        Request       $request
    ): RedirectResponse
    {
        UpsertBroadcastAction::execute($data, $request->user());

        return Redirect::route('broadcast.index');
    }

    public function create(): Response
    {
        return Inertia::render('Broadcast/Form', [
            'model' => new UpsertBroadcastViewModel(),
        ]);
    }

    public function edit(Broadcast $broadcast): Response
    {
        return Inertia::render('Broadcast/Form', [
            'model' => new UpsertBroadcastViewModel($broadcast),
        ]);
    }
}
