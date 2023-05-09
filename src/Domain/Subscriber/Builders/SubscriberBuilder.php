<?php

namespace Domain\Subscriber\Builders;

use Domain\Mail\Models\Sequence\SequenceMail;
use Illuminate\Database\Query\Builder;

class SubscriberBuilder extends Builder
{
    public function alreadyReceived(SequenceMail $mail): bool
    {
        return $this->model->received_mails()
            ->whereSendable($mail)
            ->exists();
    }
}
