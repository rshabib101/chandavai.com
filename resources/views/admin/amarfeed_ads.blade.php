@extends('adminlte::page')

@section('title', 'AmarFeed Ads Manager')

@section('content_header')
    <h1>📢 AmarFeed Ads Script Manager</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>✅ Success!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>❌ Error!</strong> {{ $errors->first() }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">
    <!-- AD SCRIPTS FORM CARD -->
    <div class="col-md-7">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-code mr-1"></i> Ad Script & Banner Manager</h3>
            </div>

            <form method="POST" action="{{ route('admin.amarfeed-ads.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <!-- HEAD AD SCRIPT -->
                    <div class="form-group">
                        <label for="ad_script_head" class="font-weight-bold">1. Header Ad Script (&lt;head&gt; section)</label>
                        <textarea name="ad_script_head" id="ad_script_head" class="form-control text-monospace" rows="3" placeholder="Paste Google Adsense or Adsterra head script here...">{{ $adScriptHead ?? '' }}</textarea>
                        <small class="form-text text-muted">Executed inside &lt;head&gt; element of every public page.</small>
                    </div>

                    <!-- IN-FEED AD SCRIPT -->
                    <div class="form-group">
                        <label for="ad_script_feed" class="font-weight-bold">2. In-Feed Ad Script (Home Feed Posts)</label>
                        <textarea name="ad_script_feed" id="ad_script_feed" class="form-control text-monospace" rows="3" placeholder="Paste In-Feed Ad HTML/JS code here...">{{ $adScriptFeed ?? '' }}</textarea>
                        <small class="form-text text-muted">Rendered dynamically between posts in the main home feed.</small>
                    </div>

                    <!-- SIDEBAR AD SCRIPT -->
                    <div class="form-group">
                        <label for="ad_script_sidebar" class="font-weight-bold">3. Sidebar Ad Script (Sidebar Widget)</label>
                        <textarea name="ad_script_sidebar" id="ad_script_sidebar" class="form-control text-monospace" rows="3" placeholder="Paste Sidebar Ad HTML/JS code here...">{{ $adScriptSidebar ?? '' }}</textarea>
                        <small class="form-text text-muted">Rendered inside the sidebar widget box on desktop view.</small>
                    </div>

                    <hr class="my-4">

                    <!-- 4. WEBSITE ENTRANCE POPUP AD -->
                    <div class="card card-outline card-success p-3 bg-light border border-success">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="font-weight-bold text-success mb-0">
                                <i class="fas fa-window-restore mr-1"></i> 4. Website Entrance Popup Ad (Pop-up Banner)
                            </h5>
                            <!-- ACTIVE TOGGLE SWITCH -->
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="popup_ad_enabled" name="popup_ad_enabled" value="1" {{ ($popupAdEnabled ?? '0') === '1' ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold text-dark" for="popup_ad_enabled" style="cursor: pointer;">
                                    Enable Popup Ad
                                </label>
                            </div>
                        </div>
                        <p class="text-muted small mb-3">
                            যখন এটি <strong>Active (Enable)</strong> থাকবে, ইউজাররা ওয়েবসাইটে ঢোকার সাথে সাথে সামনে একটি পপআপ ব্যানার অ্যাড ভেসে উঠবে।
                        </p>

                        <!-- DYNAMIC IMAGE UPLOAD / URL -->
                        <div class="form-group">
                            <label for="popup_ad_image_file" class="font-weight-bold">🖼️ Popup Ad Image</label>
                            @if(!empty($popupAdImage))
                                <div class="mb-2">
                                    <img src="{{ str_starts_with($popupAdImage, 'http') ? $popupAdImage : asset('storage/' . $popupAdImage) }}" alt="Popup Preview" class="img-thumbnail" style="max-height: 140px; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" name="popup_ad_image_file" id="popup_ad_image_file" class="form-control-file mb-2" accept="image/*">
                            <input type="text" name="popup_ad_image" id="popup_ad_image" class="form-control form-control-sm" value="{{ $popupAdImage ?? '' }}" placeholder="Or paste external image URL (https://...)">
                            <small class="form-text text-muted">Upload an image file or paste an external image URL.</small>
                        </div>

                        <!-- DYNAMIC HEADLINE -->
                        <div class="form-group">
                            <label for="popup_ad_headline" class="font-weight-bold">📝 Dynamic Headline (Image-এর নিচে)</label>
                            <input type="text" name="popup_ad_headline" id="popup_ad_headline" class="form-control" value="{{ $popupAdHeadline ?? '' }}" placeholder="e.g. 🔥 Special Discount! Get 50% Bonus Today">
                            <small class="form-text text-muted">পপআপের ছবির নিচে টাইটেল/হেডলাইন হিসাবে দেখাবে।</small>
                        </div>

                        <div class="row">
                            <!-- DYNAMIC BUTTON TEXT -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="popup_ad_button_text" class="font-weight-bold">🔘 Dynamic Button Text</label>
                                    <input type="text" name="popup_ad_button_text" id="popup_ad_button_text" class="form-control" value="{{ $popupAdButtonText ?? '' }}" placeholder="e.g. Visit Now / Claim Offer">
                                    <small class="form-text text-muted">হেডলাইনের পাশে বাটনের নাম।</small>
                                </div>
                            </div>

                            <!-- DYNAMIC BUTTON LINK -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="popup_ad_button_link" class="font-weight-bold">🔗 Dynamic Button Link (URL)</label>
                                    <input type="url" name="popup_ad_button_link" id="popup_ad_button_link" class="form-control" value="{{ $popupAdButtonLink ?? '' }}" placeholder="e.g. https://example.com/offer">
                                    <small class="form-text text-muted">বাটনে ক্লিক করলে যে লিংকে নিয়ে যাবে।</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block font-weight-bold">
                        💾 Save AmarFeed Ad Scripts & Popup Ad
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- INFORMATION / PREVIEW CARD -->
    <div class="col-md-5">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle mr-1"></i> How AmarFeed Ads Work</h3>
            </div>
            <div class="card-body">
                <div class="callout callout-info">
                    <h5><i class="fas fa-code text-info"></i> 1. Header Script</h5>
                    <p class="text-muted mb-0">Required by ad networks like Google AdSense or Adsterra to verify domain ownership and serve auto-ads.</p>
                </div>
                <div class="callout callout-success">
                    <h5><i class="fas fa-newspaper text-success"></i> 2. In-Feed Script</h5>
                    <p class="text-muted mb-0">Shows ad banners natively between posts on the home feed page.</p>
                </div>
                <div class="callout callout-warning">
                    <h5><i class="fas fa-columns text-warning"></i> 3. Sidebar Script</h5>
                    <p class="text-muted mb-0">Displays ad widgets in the right sidebar section of the main layout.</p>
                </div>
                <div class="callout callout-danger" style="border-left-color: #28a745;">
                    <h5 class="text-success"><i class="fas fa-window-restore text-success"></i> 4. Entrance Popup Ad</h5>
                    <p class="text-muted mb-0">Displays an interactive pop-up banner (Image, Headline, and Action Button) directly when users open the site.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
