<?php

namespace App\Http\Controllers;

use App\Jobs\CountScore;
use App\Jobs\TrustScoreBank;
use App\Models\TrustBank;
use App\Models\TrustCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function ajaxResponse(Request $request)
    {
        $countScore = new CountScore($request);
        $countScore->handle();
        $score = $countScore->getScore();

        $trustBank = new TrustScoreBank($score);

        return response()->json([
            $trustBank->handle()
        ]);
    }
}
