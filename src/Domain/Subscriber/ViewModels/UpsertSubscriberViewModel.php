<?php

namespace Domain\Subscriber\ViewModels;

use Domain\Shared\ViewModels\ViewModel;
use Domain\Subscriber\DataTransferObjects\SubscriberData;
use Domain\Subscriber\DataTransferObjects\TagData;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Support\Collection;

class UpsertSubscriberViewModel extends ViewModel
{
    public function __construct(
        public readonly ?Subscriber $subscriber = null
    ){}

    public function subscriber(): ?Subscriber
    {
        if (!$this->subscriber) {
            return null;
        }

        return SubscriberData::from(
            $this->subscriber->load('tags', 'form')
        );
    }

    public function tags(): Collection
    {
        return Tag::all()->map(fn (Tag $tag) => TagData::from($tag));
    }

    public function forms(): Collection
    {
        return Form::all()->map(fn (Form $form) => TagData::from($form));
    }

}
