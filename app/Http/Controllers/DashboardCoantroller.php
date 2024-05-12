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
        ]);
    }

    private function getPieChartData()
    {
        $pieChartData = [
            'provinces' => [],
            'user_counts' => []
        ];

        $usersCountByProvince = User::select('province', DB::raw('count(*) as user_count'))
            ->groupBy('province')
            ->orderBy('province')
            ->get();

        foreach ($usersCountByProvince as $data) {
            $pieChartData['provinces'][] = $data['province'];
            $pieChartData['user_counts'][] = $data['user_count'];
        }

        return $pieChartData;
    }

    private function getHistogramChartData()
    {
        $histogramData = [
            'age_range' => [],
            'user_counts' => []
        ];

        $ageGroups = User::select(
            DB::raw('CONCAT(FLOOR(age / 5) * 5, "-", (FLOOR(age / 5) + 1) * 5 - 1) as age_range'),
            DB::raw('COUNT(*) as count')
        )
            ->groupBy('age_range')
            ->orderBy('age_range')
            ->get();



            foreach ($ageGroups as $data) {
                $histogramData['age_range'][] = $data['age_range'];
                $histogramData['user_counts'][] = $data['count'];
            }
    
            return $histogramData;
    }
}
