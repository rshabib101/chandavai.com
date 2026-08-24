@php
    $popupAdEnabled = \App\Models\Setting::get('popup_ad_enabled', '0');
    $popupAdImage = \App\Models\Setting::get('popup_ad_image', '');
    $popupAdHeadline = \App\Models\Setting::get('popup_ad_headline', '');
    $popupAdButtonText = \App\Models\Setting::get('popup_ad_button_text', '');
    $popupAdButtonLink = \App\Models\Setting::get('popup_ad_button_link', '');

    $imgSrc = '';
    if (!empty($popupAdImage)) {
        if (str_starts_with($popupAdImage, 'http://') || str_starts_with($popupAdImage, 'https://')) {
            $imgSrc = $popupAdImage;
        } else {
            $imgSrc = asset('storage/' . $popupAdImage);
        }
    }
@endphp

@if($popupAdEnabled === '1' && (!empty($imgSrc) || !empty($popupAdHeadline)))
<div id="amarfeedPopupAdOverlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); z-index: 999999; display: flex; align-items: center; justify-content: center; padding: 16px;">
    <div style="position: relative; width: 100%; max-width: 440px; background: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); animation: amarfeedPopupBounce 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        
        <!-- CLOSE BUTTON (TOP RIGHT OVERLAY) -->
        <button type="button" onclick="closeAmarfeedPopupAd()" aria-label="Close Ad" style="position: absolute; top: 12px; right: 12px; width: 34px; height: 34px; border-radius: 50%; background: rgba(15, 23, 42, 0.65); color: #ffffff; border: 2px solid rgba(255,255,255,0.4); font-size: 20px; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 20; transition: all 0.2s;" onmouseover="this.style.background='rgba(15,23,42,0.95)'; this.style.transform='scale(1.1)';" onmouseout="this.style.background='rgba(15,23,42,0.65)'; this.style.transform='scale(1)';">&times;</button>

        <!-- DYNAMIC IMAGE -->
        @if(!empty($imgSrc))
            <a href="{{ $popupAdButtonLink ?: 'javascript:void(0)' }}" @if(!empty($popupAdButtonLink)) target="_blank" @endif style="display: block; width: 100%; overflow: hidden; background: #f8fafc;">
                <img src="{{ $imgSrc }}" alt="Popup Ad" style="width: 100%; max-height: 280px; object-fit: cover; display: block; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
            </a>
        @endif

        <!-- HEADLINE & BUTTON ROW BELOW IMAGE -->
        <div style="padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; gap: 14px; background: #ffffff; border-top: 1px solid #f1f5f9;">
            <div style="flex: 1; min-width: 0;">
                <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #0f172a; line-height: 1.35; word-break: break-word;">
                    {{ $popupAdHeadline }}
                </h4>
            </div>
            @if(!empty($popupAdButtonText))
                <a href="{{ $popupAdButtonLink ?: 'javascript:void(0)' }}" @if(!empty($popupAdButtonLink)) target="_blank" @endif onclick="closeAmarfeedPopupAd()" style="background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #ffffff; padding: 10px 18px; border-radius: 12px; font-weight: 700; font-size: 14px; text-decoration: none; white-space: nowrap; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35); flex-shrink: 0; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(37, 99, 235, 0.45)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(37, 99, 235, 0.35)';">
                    <span>{{ $popupAdButtonText }}</span>
                    <i class="fas fa-arrow-right" style="font-size: 12px;"></i>
                </a>
            @endif
        </div>
    </div>
</div>

<style>
@keyframes amarfeedPopupBounce {
    0% { opacity: 0; transform: scale(0.85) translateY(20px); }
    100% { opacity: 1; transform: scale(1) translateY(0); }
}
</style>

<script>
function closeAmarfeedPopupAd() {
    const overlay = document.getElementById('amarfeedPopupAdOverlay');
    if (overlay) {
        overlay.style.opacity = '0';
        overlay.style.transition = 'opacity 0.2s ease-out';
        setTimeout(() => overlay.remove(), 200);
    }
}
</script>
@endif
