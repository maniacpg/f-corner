<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RevenueController extends Controller

{
    public function index()
    {
        $currentYear = now()->year;
        $availableYears = range($currentYear - 4, $currentYear); // Tạo mảng năm
        $monthlyRevenue = $this->getMonthlyRevenue($currentYear);
        $selectedYear = $currentYear;
        dd($availableYears); // Dừng lại và kiểm tra
//        return view('home', [
//            'monthlyRevenue' => $monthlyRevenue,
//            'availableYears' => $availableYears,
//            'selectedYear' => $selectedYear
//        ]);
    }

    private function getMonthlyRevenue($year)
    {
        $cacheKey = "monthly_revenue_{$year}";

        return Cache::remember($cacheKey, now()->addHours(24), function () use ($year) {
            $revenueData = Invoice::whereYear('created_at', $year)
                ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('total', 'month')
                ->toArray();

            // Ensure all 12 months are represented
            $monthlyRevenue = array_fill(1, 12, 0);
            foreach ($revenueData as $month => $total) {
                $monthlyRevenue[$month] = round($total, 2);
            }

            return $monthlyRevenue;
        });
    }
    public function getMonthlyRevenueByYear($year)
    {
        $revenueData = Invoice::whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Đảm bảo có 12 tháng, mặc định là 0
        $monthlyRevenue = array_fill(1, 12, 0);
        foreach ($revenueData as $month => $total) {
            $monthlyRevenue[$month] = round($total, 2);
        }

        return response()->json($monthlyRevenue);
    }

}
