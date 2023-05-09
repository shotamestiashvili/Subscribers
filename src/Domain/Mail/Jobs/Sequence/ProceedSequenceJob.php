<?php

namespace Domain\Mail\Jobs\Sequence;

use Domain\Mail\Actions\Sequence\ProceedSequenceAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProceedSequenceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable,
        SerializesModels;

    public function __construct(private readonly Sequence $sequence)
    {
    }

    public function handle()
    {
        ProceedSequenceAction::execute($this->sequence);
    }
}
