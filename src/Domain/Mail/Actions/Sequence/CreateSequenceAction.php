<?php

namespace Domain\Mail\Actions\Sequence;

use Domain\Subscriber\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\DB;
use Shared\Models\User;

class CreateSequenceAction
{
    public static function execute(
        SequenceData $data,
        User $user
    ): Sequence {
        return DB::transaction(function () use ($data, $user) {
            $sequence = Sequence::create([
               ...$data->all(),
               'user_id' =>  $user->id,
            ]);

            UpsertSequenceMailAction::execute(
                SequenceMailData::dumy(),
                $sequence,
                $user
            );
        });

        $sequence->subscribers()->sync(
            Subscriber::select('id')->pluck('id')
        );

        return $sequence;
    }
}
