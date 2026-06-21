<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'portfolios' => DB::table('portfolios')->count(),
            'certifications' => DB::table('certifications')->count(),
            'achievements' => DB::table('achievements')->count(),
            'gallery' => DB::table('gallery')->count(),
            'contacts' => DB::table('contacts')->count(),
        ];

        return view('admin.dashboard', compact('counts'));
    }
}
