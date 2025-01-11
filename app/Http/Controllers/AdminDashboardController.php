<?php

namespace App\Http\Controllers;

use DB;
use App\Models\PemilikUmkm;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function chart()
    {
        $totalPemilikUmkm = PemilikUmkm::distinct('id_umkm')->count('id_umkm');

        return view('dashboard.admin.dashboard', compact('totalPemilikUmkm'));
    }
}
