<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResellerSurvey;

class ResellerSurveyController extends Controller
{
    public function create()
    {
        return view('frontend.survey');
    }

    public function store(Request $request)
    {
        ResellerSurvey::create([
            'full_name' => $request->full_name,
            'mobile' => $request->mobile,
            'facebook' => $request->facebook,
            'district' => $request->district,
            'profession' => $request->profession,
            'business_before' => $request->business_before,
            'platform' => $request->platform,
            'product' => json_encode($request->product),
            'monthly_target' => $request->monthly_target,
            'stock_type' => $request->stock_type,
            'package' => $request->package,
            'reason' => $request->reason,
            'agreement' => $request->agreement ? 1 : 0
        ]);

        return back()->with('success', 'Form Submitted Successfully!');
    }

    public function index()
    {
        $surveys = ResellerSurvey::latest()->get();
        return view('admin.survey-admin', compact('surveys'));
    }
}
