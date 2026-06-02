<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = Report::where('status', 'approved')
            ->latest()
            ->paginate(4);

        if ($request->ajax()) {
            return view('partials.posts', compact('reports'))->render();
        }

        return view('index', compact('reports'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {


        $thana = null;
        $district = null;
        $division = null;

        // ১. JSON ফাইল থেকে বিভাগের বাংলা নাম বের করা
        if ($request->division_id && file_exists(public_path('location/divisions.json'))) {
            // এখানে file_get_contents() ব্যবহার করা হয়েছে
            $divisionsData = json_decode(file_get_contents(public_path('location/divisions.json')), true);
            $divisionsList = $divisionsData[2]['data'] ?? [];
            foreach ($divisionsList as $div) {
                if ($div['id'] == $request->division_id) {
                    $division = $div['bn_name'];
                    break;
                }
            }
        }

        // ২. JSON ফাইল থেকে জেলার বাংলা নাম বের করা
        if ($request->district_id && file_exists(public_path('location/districts.json'))) {
            // এখানে file_get_contents() ব্যবহার করা হয়েছে
            $districtsData = json_decode(file_get_contents(public_path('location/districts.json')), true);
            $districtsList = $districtsData[2]['data'] ?? [];
            foreach ($districtsList as $dist) {
                if ($dist['id'] == $request->district_id) {
                    $district = $dist['bn_name'];
                    break;
                }
            }
        }

        // ③. JSON ফাইল থেকে থানার বাংলা নাম বের করা
        if ($request->location && file_exists(public_path('location/upazilas.json'))) {
            // এখানে file_get_contents() ব্যবহার করা হয়েছে
            $upazilasData = json_decode(file_get_contents(public_path('location/upazilas.json')), true);
            $upazilasList = $upazilasData[2]['data'] ?? [];
            foreach ($upazilasList as $upazila) {
                if ($upazila['id'] == $request->location) {
                    $thana = $upazila['bn_name'];
                    break;
                }
            }
        }

        // ৪. নামগুলো একসাথে যুক্ত করা (যেমন: "মিরপুর, ঢাকা, ঢাকা")
        $fullLocation = implode(', ', array_filter([$thana, $district, $division]));

        // যদি JSON থেকে নাম না পাওয়া যায়, তবে ব্যাকআপ হিসেবে আইডিটাই সেভ হবে
        if (empty($fullLocation)) {
            $fullLocation = $request->location;
        }



        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reports', 'public');
        }

        Report::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $fullLocation, // এখানে পুরো বাংলা টেক্সট স্ট্রিং হিসেবে সেভ হচ্ছে
            'category' => $request->category,
            'image' => $imagePath,
            'video_url' => $request->video_url,
            'status' => 'pending',
            'is_anonymous' => 1
        ]);

        return redirect('/');
    }


    public function admin()
    {
        $reports = Report::latest()->get();
        return view('admin.reports', compact('reports'));
    }

    public function approve($id)
    {
        $report = Report::findOrFail($id);
        $report->status = 'approved';
        $report->save();

        return back();
    }

    public function reject($id)
    {
        $report = Report::findOrFail($id);
        $report->status = 'rejected';
        $report->save();

        return back();
    }

    public function delete($id)
    {
        $report = Report::findOrFail($id);

        // image delete (optional)
        if ($report->image && file_exists(public_path('storage/' . $report->image))) {
            unlink(public_path('storage/' . $report->image));
        }

        $report->delete();

        return redirect()->back()->with('success', 'Report deleted successfully!');
    }
}
