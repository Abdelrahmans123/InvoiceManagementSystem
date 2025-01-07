<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count = Invoice::count();
        if ($count > 0) {
            $unpaidCount = Invoice::where('valueStatus', "=", 2)->count();
            $unpaidPercentage = ($unpaidCount / $count) * 100;
            $paidCount = Invoice::where('valueStatus', "=", 1)->count();
            $paidPercentage = ($paidCount / $count) * 100;
            $partialPaidCount = Invoice::where('valueStatus', "=", 3)->count();
            $partialPaidPercentage = ($partialPaidCount / $count) * 100;
            $barChart = app()->chartjs
                ->name('barChartTest')
                ->type('bar')
                ->size(['width' => 350, 'height' => 200])
                ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
                ->datasets([
                    [
                        "label" => "الفواتير الغير المدفوعة",
                        'backgroundColor' => ['#ec5858'],
                        'data' => [$unpaidPercentage]
                    ],
                    [
                        "label" => "الفواتير المدفوعة",
                        'backgroundColor' => ['#22C55E'],
                        'data' => [$paidPercentage]
                    ],
                    [
                        "label" => "الفواتير المدفوعة جزئيا",
                        'backgroundColor' => ['#ff9642'],
                        'data' => [$partialPaidPercentage]
                    ],


                ])
                ->options([]);
            $pieChart = app()->chartjs
                ->name('pieChartTest')
                ->type('pie')
                ->size(['width' => 340, 'height' => 200])
                ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
                ->datasets([
                    [
                        'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                        'data' => [$unpaidPercentage, $paidPercentage, $partialPaidPercentage]
                    ]
                ])
                ->options([]);

            return view('home', compact('pieChart', 'barChart'));
        }else{
            return view('home');
        }
    }


}
