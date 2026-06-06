<?php



namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ResellerSurvey;

class DashboardController extends Controller

{

    public function index()

    {

        $pending = Report::where('status', 'pending')->count();

        $approved = Report::where('status', 'approved')->count();

        $rejected = Report::where('status', 'rejected')->count();
        $applications = ResellerSurvey::count();


        return view('dashboard', compact('pending', 'approved', 'rejected', 'applications'));
    }
}
