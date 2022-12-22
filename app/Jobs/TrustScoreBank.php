<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\TrustBank;

class TrustScoreBank implements ShouldQueue
{
    private $score;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($score)
    {
        $this->score = $score;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return TrustBank::where('score_trust', '<', $this->score)->orderBy('id', 'desc')->get();
    }
}
