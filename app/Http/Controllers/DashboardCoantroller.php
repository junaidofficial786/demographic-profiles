<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardCoantroller extends Controller
{
    public function index()
    {
        $users = User::where('approved', 0)->latest()->paginate(10);

        return view('dashboard', [
            'users' => $users,
            'pieChartData' => $this->getPieChartData(),
            'histogramData' => $this->getHistogramChartData(),
            'areaChartData' => $this->getAreaChartData()
        ]);
    }

    private function getPieChartData()
    {
        $usersCountByProvince = User::select('province', DB::raw('count(*) as user_count'))
            ->groupBy('province')
            ->orderBy('province')
            ->get();

        $pieChartData['provinces'] = $usersCountByProvince->pluck('province');
        $pieChartData['user_counts'] = $usersCountByProvince->pluck('user_count');

        return $pieChartData;
    }

    private function getHistogramChartData()
    {
        $ageGroups = User::select(
            DB::raw('CONCAT(FLOOR(age / 5) * 5, "-", (FLOOR(age / 5) + 1) * 5 - 1) as age_range'),
            DB::raw('COUNT(*) as count')
        )
            ->groupBy('age_range')
            ->orderBy('age_range')
            ->get();

        $histogramData['age_range'] = $ageGroups->pluck('age_range');
        $histogramData['user_counts'] = $ageGroups->pluck('count');

        return $histogramData;
    }

    private function getAreaChartData()
    {
        // Get the count of users created on each day for the past 30 days (adjust as needed)
        $userCounts = User::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Prepare data for the chart
        $areaChartdata['creation_dates'] = $userCounts->pluck('date');
        $areaChartdata['user_counts'] = $userCounts->pluck('count');

        return $areaChartdata;
    }
}
