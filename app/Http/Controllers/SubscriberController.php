<?php

namespace App\Http\Controllers;

use Domain\Subscriber\Actions\UpsertSubscriberAction;
use Domain\Subscriber\DataTransferObjects\SubscriberData;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class SubscriberController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Subscriber/List', [
            'model' => new GetSubscribersViewModel(
                $request->get('page', 1)
            )
        ]);
    }

    public function update(SubscriberData $data, Request $request): RedirectResponse
    {
        UpsertSubscriberAction::execute($data, $request->user());
        return Redirect::route('subscribers.index');
    }

    public function create(): Response
    {
        return Inertia::render('Subscriber/Form', [
            'model' => new UpsertSubscriberViewModel(),
        ]);
    }

    public function edit(Subscriber $subscriber): Response
    {
        return Inertia::render('Subscriber/Form', [
            'model' => new UpsertSubscriberViewModel($subscriber),
        ]);
    }
}
