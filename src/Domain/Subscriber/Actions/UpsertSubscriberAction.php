<?php

namespace Domain\Subscriber\Actions;

use Domain\Subscriber\DataTransferObjects\SubscriberData;
use Domain\Subscriber\Models\Subscriber;
use Shared\Models\User;

class UpsertSubscriberAction
{
    public static function execute(
        SubscriberData $data,
        User $user
    ): Subscriber {
        $subscriber = Subscriber::updateOrCreate(
            [
                'id' => $data->id,
            ],
            [
                ...$data->all(),
                'form_id' => $data->form?->id,
                'user_id' => $user->id,
            ],
        );

        $subscriber->tags()->sync(
            $data->tags->toCollection()->pluck('id')
        );

        return $subscriber->load('tags', 'form');
    }
}
