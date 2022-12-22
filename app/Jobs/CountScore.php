<?php

namespace App\Jobs;

use App\Models\TrustCategory;
use Illuminate\Contracts\Queue\ShouldQueue;

class CountScore implements ShouldQueue
{
    public $data;
    public $score = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->data = [
            ['name' => $request->age['name'], 'value' => $request->age['value']],
            ['name' => $request->marriage['name'], 'value' => $request->marriage['value']],
            ['name' => $request->children['name'], 'value' => $request->children['value']],
            ['name' => $request->education['name'], 'value' => $request->education['value']],
            ['name' => $request->house['name'], 'value' => $request->house['value']],
            ['name' => $request->car['name'], 'value' => $request->car['value']],
            ['name' => $request->work['name'], 'value' => $request->work['value']],
            ['name' => $request->experience['name'], 'value' => $request->experience['value']],
            ['name' => $request->salary['name'], 'value' => $request->salary['value']],
            ['name' => $request->creditHistory['name'], 'value' => $request->creditHistory['value']],
            ['name' => $request->guarantor['name'], 'value' => $request->guarantor['value']],
            ['name' => $request->countCredit['name'], 'value' => $request->countCredit['value']],
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    private function countingScore($score) {
        $this->score += $score;
    }

    public function handle()
    {
        foreach ($this->data as $data) {
            $countScore = TrustCategory::where('name', $data['name'])->where('responce_id', $data['value'])->first();
            $this->countingScore($countScore->score);
        }
    }

    public function getScore() {
        return $this->score;
    }
}
