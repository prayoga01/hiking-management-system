<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Group;
use App\Models\Mountain;
use App\Models\Regulation;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $regulations = Regulation::all();
        $mountains = Mountain::all();
        return view('landing', compact('mountains', 'regulations'));
    }

    
    

    
    // public function handleAdmin()
    // {
    //     return view('admin.index');

    // } 
    
    // public function handleAdmin()
    // {
    //     $currentMonth = Carbon::now()->format('Y-m');
    //     $newPaymentsCount = Payment::where('status_pay', 0)->count();
    //     $incomeThisMonth = Payment::where('status_pay', 1)
    //         ->whereYear('pay_date', Carbon::now()->year)
    //         ->whereMonth('pay_date', Carbon::now()->month)
    //         ->sum('total');
    //     $mountains = Mountain::all();
    //     //tambahan
    //     $groupCheckInData = DB::table('groups')
    //         ->select(DB::raw('DATE_FORMAT(checkIn, "%b") as month'), DB::raw('COUNT(*) as total'))
    //         ->whereYear('checkIn', Carbon::now()->year)
    //         ->whereMonth('checkIn', Carbon::now()->month)
    //         ->groupBy('month')
    //         ->get();

    //     $groups = Group::selectRaw('MONTH(checkIn) as month, COUNT(*) as count')
    //         ->groupBy('month')
    //         ->orderBy('month')
    //         ->get();

    //     $statusCounts = Group::selectRaw('status, COUNT(*) as count')
    //         ->groupBy('status')
    //         ->get();

    //     $ageGroups = Reservation::selectRaw('CASE 
    //         WHEN age < 17 THEN "< 17 years old"
    //         WHEN age BETWEEN 18 AND 39 THEN "18-39 years old"
    //         WHEN age BETWEEN 40 AND 59 THEN "40-59 years old"
    //         ELSE ">60 years old"
    //         END as age_group, COUNT(*) as count')
    //         ->groupBy('age_group')
    //         ->get();

    //          // Ubah data tersebut menjadi format yang dapat digunakan oleh grafik
    //     $labels = $ageGroups->pluck('age_group');
    //     $data = $ageGroups->pluck('count');
        
    //     // return view('admin.index', compact('newPaymentsCount', 'incomeThisMonth', 'mountains', 'groupCheckInData', 'groups', 'statusCounts'));
    //     return view('admin.index', compact('newPaymentsCount', 'incomeThisMonth', 'mountains', 'groupCheckInData', 'groups', 'statusCounts', 'labels', 'data'));
    // }

    public function handleAdmin(Request $request)
    {
        $currentMonth = Carbon::now()->format('Y-m');
        $newPaymentsCount = Payment::where('status_pay', 0)->count();
        $incomeThisMonth = Payment::where('status_pay', 1)
            ->whereYear('pay_date', Carbon::now()->year)
            ->whereMonth('pay_date', Carbon::now()->month)
            ->sum('total');
        $mountains = Mountain::all();

        //tambahan
        $groupCheckInData = DB::table('groups')
            ->select(DB::raw('DATE_FORMAT(checkIn, "%b") as month'), DB::raw('COUNT(*) as total'))
            ->whereYear('checkIn', Carbon::now()->year)
            ->whereMonth('checkIn', Carbon::now()->month)
            ->groupBy('month')
            ->get();

        $groups = Group::selectRaw('MONTH(checkIn) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $statusCounts = Group::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // Ambil bulan dan tahun yang dipilih oleh pengguna dari request
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');

        // Jika bulan dan tahun tidak dipilih, gunakan bulan dan tahun saat ini
        if (!$selectedMonth || !$selectedYear) {
            $selectedMonth = Carbon::now()->format('n');
            $selectedYear = Carbon::now()->format('Y');
        }

        // Ambil data umur pendaki dari tabel reservation berdasarkan bulan dan tahun yang dipilih
        $startOfMonth = Carbon::parse("{$selectedYear}-{$selectedMonth}-01")->startOfMonth();
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        $ageGroups = DB::table('groups')
            ->join('reservations', 'groups.id', '=', 'reservations.group_id')
            ->selectRaw('CASE 
                WHEN age < 17 THEN "< 17 years old"
                WHEN age BETWEEN 18 AND 39 THEN "18-39 years old"
                WHEN age BETWEEN 40 AND 59 THEN "40-59 years old"
                ELSE ">60 years old"
            END as age_group, COUNT(*) as count')
            ->whereBetween('groups.checkIn', [$startOfMonth, $endOfMonth])
            ->groupBy('age_group')
            ->get();

        // Ubah data tersebut menjadi format yang dapat digunakan oleh grafik
        $labels = $ageGroups->pluck('age_group');
        $data = $ageGroups->pluck('count');

        return view('admin.index', compact(
            'newPaymentsCount', 'incomeThisMonth', 'mountains', 'groupCheckInData', 'groups',
            'statusCounts', 'labels', 'data', 'selectedMonth', 'selectedYear'
        ));
    }


}