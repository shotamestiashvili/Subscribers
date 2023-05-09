<?php

namespace Domain\Mail\ViewModels\Broadcast;

use Domain\Mail\Actions\GetPerformanceAction;
use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Shared\ViewModels\ViewModel;
use Ramsey\Collection\Collection;

class GetBroadcastsViewModel extends ViewModel
{
    public function broadcasts(): Collection
    {
        return Broadcast::latest()->get()->map->getData();
    }

    public function performances(): Collection
    {
        return Broadcast::all()
            ->mapWithKeys(fn (Broadcast $broadcast) => [
                $broadcast->id => GetPerformanceAction::execute(
                    $broadcast
                ),
            ]);
    }
}
