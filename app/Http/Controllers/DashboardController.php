<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestResults;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();

        $testCount = TestResults::where('user_id', $user->id)->count();
        $bestScore = TestResults::where('user_id', $user->id)->max('score');
        $avgScore = TestResults::where('user_id', $user->id)->avg('score');
        $above50Count = TestResults::where('user_id', $user->id)->whereRaw('(score / 60) * 100 > 50')->count();

        return view ('dashboard', compact('testCount', 'bestScore', 'avgScore', 'above50Count'));
    }
}
