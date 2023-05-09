<?php

namespace Domain\Subscriber\Actions;

use Domain\Subscriber\DataTransferObjects\SubscriberData;
use Domain\Subscriber\Models\Subscriber;
use Shared\Models\User;

class ImportSubscribersAction
{
    public static function execute(
        string $path,
        User $user
    ): void {
        ReadCsvAction::execute($path)->each(function (array $row) use ($user){
            $parsed = [
                ...$row,
                'tags' => self::parseTags($row, $user),
            ];

            $data = SubscriberData::from($parsed);

            if (self::isSubscreberExist($data, $user)) {
                return;
            }

            UpsertSubscriberAction::execute($data,$user);
        });
    }

    private static function parseTags(array $row, User $user): Array
    {
        $tags = collect(explode(',', $row['tags']))->filter()->toArray();

        return self::getOrCreateTags($tags, $user);
    }

    private static function getOrCreateTags(
        array $tags,
        User $user,
    ): array {
        return collect($tags)->map(fn (string $title) => Tag::firstOrCreate([
            'title' => $title,
            'user_id' => $user->id,
        ]))->toArray();
    }

    private static function isSubscriberExist(
        SubscriberData $data,
        User $user,
    ): bool{
        return Subscriber::query()
            ->whereEmail($data->email)
            ->whereBelongsTo($user)
            ->exists();
    }
}
