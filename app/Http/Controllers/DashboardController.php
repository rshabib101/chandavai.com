<?php



namespace App\Http\Controllers;

use App\Models\Report;

use Illuminate\Http\Request;



class DashboardController extends Controller

{

        public function index()

    {

        $pending = Report::where('status', 'pending')->count();

        $approved = Report::where('status', 'approved')->count();

        $rejected = Report::where('status', 'rejected')->count();



        return view('dashboard', compact('pending', 'approved', 'rejected'));

    }

}
