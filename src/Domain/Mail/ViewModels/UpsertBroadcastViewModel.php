<?php

namespace Domain\Mail\ViewModels;

use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Shared\ViewModels\ViewModel;

class UpsertBroadcastViewModel extends ViewModel
{
    use HasTags;
    use HasForms;

    public function __construct(
        public readonly ?Broadcast $broadcast = null
    ){}

    public function broadcast(): ? Broadcast
    {
        if (!$this->broadcast) {
            return null;
        }

        return $this->broadcast->getData();
    }
}
