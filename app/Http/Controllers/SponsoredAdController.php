<?php

namespace App\Http\Controllers;

use App\Models\SponsoredAd;
use Illuminate\Http\Request;

class SponsoredAdController extends Controller
{
    /**
     * Display Ad Manager panel.
     */
    /**
     * Display Ad Manager panel.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        if (!$user || !$user->isAdvertiser()) {
            return redirect()->route('user.analytics')->with('error', 'Only users with Advertiser or Admin role can access Ad Manager.');
        }

        $ads = SponsoredAd::where('user_id', $user->id)->latest()->get();
        $userPosts = \App\Models\Report::where('user_id', $user->id)->where('status', 'approved')->latest()->get();

        return view('profile.ad_manager', compact('user', 'ads', 'userPosts'));
    }

    /**
     * Store a new sponsored ad.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user || !$user->isAdvertiser()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized access'], 403);
        }

        $validated = $request->validate([
            'existing_report_id' => 'nullable|exists:reports,id',
            'primary_text' => 'nullable|string|max:2000',
            'headline' => 'required|string|max:255',
            'cta_text' => 'required|string|in:Order now,Shop now,Install now,Visit now,Apply now',
            'destination_link' => 'required|url|max:500',
            'placement' => 'required|string|in:feed,reels,both',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4,mov,avi,webm|max:51200',
        ]);

        $mediaType = 'image';
        $mediaPath = null;
        $report = null;

        if ($request->filled('existing_report_id')) {
            $report = \App\Models\Report::where('user_id', $user->id)->findOrFail($request->existing_report_id);

            if ($report->video) {
                $mediaType = 'video';
                $mediaPath = $report->video;
            } else {
                $mediaType = 'image';
                $mediaPath = !empty($report->image_list) ? $report->image_list[0] : ($report->image ?: null);
            }

            if ($request->hasFile('media') && $request->file('media')->isValid()) {
                $file = $request->file('media');
                $mime = $file->getMimeType();
                if (str_starts_with($mime, 'video/') || in_array($file->getClientOriginalExtension(), ['mp4', 'mov', 'avi', 'webm'])) {
                    $mediaType = 'video';
                }
                $mediaPath = $file->store('ads', 'public');
                if ($mediaType === 'video') {
                    $report->video = $mediaPath;
                } else {
                    $report->image = $mediaPath;
                    $report->images = [$mediaPath];
                }
            }

            $report->update([
                'title' => $validated['headline'],
                'description' => $validated['primary_text'] ?: $report->description,
                'cta_text' => $validated['cta_text'],
                'destination_link' => $validated['destination_link'],
            ]);
        } else {
            if (!$request->hasFile('media')) {
                return response()->json(['status' => 'error', 'message' => 'Please upload a photo or video for your new ad!'], 422);
            }

            if ($request->hasFile('media') && $request->file('media')->isValid()) {
                $file = $request->file('media');
                $mime = $file->getMimeType();
                if (str_starts_with($mime, 'video/') || in_array($file->getClientOriginalExtension(), ['mp4', 'mov', 'avi', 'webm'])) {
                    $mediaType = 'video';
                }
                $mediaPath = $file->store('ads', 'public');
            }

            $report = \App\Models\Report::create([
                'user_id' => $user->id,
                'title' => $validated['headline'],
                'description' => $validated['primary_text'],
                'status' => 'approved',
                'image' => $mediaType === 'image' ? $mediaPath : null,
                'images' => $mediaType === 'image' ? [$mediaPath] : null,
                'video' => $mediaType === 'video' ? $mediaPath : null,
                'cta_text' => $validated['cta_text'],
                'destination_link' => $validated['destination_link'],
            ]);
        }

        $ad = SponsoredAd::create([
            'user_id' => $user->id,
            'report_id' => $report->id,
            'primary_text' => $validated['primary_text'] ?: ($report->description ?: ''),
            'media_type' => $mediaType,
            'media_path' => $mediaPath,
            'headline' => $validated['headline'],
            'cta_text' => $validated['cta_text'],
            'destination_link' => $validated['destination_link'],
            'placement' => $validated['placement'],
            'is_active' => true,
        ]);

        $report->update(['sponsored_ad_id' => $ad->id]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Ad created successfully & posted to your profile! 🎉',
                'ad' => $ad,
                'report' => $report
            ]);
        }

        return redirect()->back()->with('success', 'Ad created & posted to your profile!');
    }

    /**
     * Toggle Ad active/inactive status.
     */
    public function toggleActive(Request $request, $id)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $ad = SponsoredAd::findOrFail($id);
        if ($ad->user_id !== $user->id && !$user->isAdmin()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $ad->is_active = !$ad->is_active;
        $ad->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'is_active' => $ad->is_active,
                'message' => 'Ad status updated to ' . ($ad->is_active ? 'Active' : 'Inactive')
            ]);
        }

        return redirect()->back()->with('success', 'Ad status updated!');
    }

    /**
     * Delete an ad.
     */
    public function destroy(Request $request, $id)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $ad = SponsoredAd::findOrFail($id);
        if ($ad->user_id !== $user->id && !$user->isAdmin()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        if ($ad->media_path && file_exists(public_path('storage/' . $ad->media_path))) {
            @unlink(public_path('storage/' . $ad->media_path));
        }

        if ($ad->report_id) {
            \App\Models\Report::where('id', $ad->report_id)->delete();
        }

        $ad->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Ad deleted successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'Ad deleted successfully.');
    }

    /**
     * Track ad click.
     */
    public function trackClick($id)
    {
        $ad = SponsoredAd::find($id);
        if ($ad) {
            $ad->increment('clicks_count');
        }
        return response()->json(['status' => 'success']);
    }
}
