<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class TrackUserSession
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $ip = $request->ip();
            $userAgent = $request->header('User-Agent') ?? '';
            $referrer = $request->header('referer') ?? $request->server('HTTP_REFERER');
            $language = $request->header('Accept-Language');

            // Parse User Agent
            $browser = $this->getBrowser($userAgent);
            $os = $this->getOS($userAgent);
            $deviceType = $this->getDeviceType($userAgent);

            // Geo IP lookup (Country / City)
            $country = $user->country;
            $city = $user->city;

            if ($user->last_ip_address !== $ip || empty($country)) {
                if ($this->isLocalIp($ip)) {
                    $country = 'Local Host / Private IP';
                    $city = 'Local Network';
                } else {
                    try {
                        $geoRes = Http::timeout(2)->get("http://ip-api.com/json/{$ip}?fields=status,country,city");
                        if ($geoRes->successful() && $geoRes->json('status') === 'success') {
                            $country = $geoRes->json('country') ?? 'Unknown';
                            $city = $geoRes->json('city') ?? 'Unknown';
                        }
                    } catch (\Throwable $e) {
                        $country = $country ?? 'Unknown';
                        $city = $city ?? 'Unknown';
                    }
                }
            }

            // Update user record if changed
            $updates = [];
            if ($user->last_ip_address !== $ip) $updates['last_ip_address'] = $ip;
            if ($user->country !== $country) $updates['country'] = $country;
            if ($user->city !== $city) $updates['city'] = $city;
            if ($user->browser !== $browser) $updates['browser'] = $browser;
            if ($user->operating_system !== $os) $updates['operating_system'] = $os;
            if ($user->device_type !== $deviceType) $updates['device_type'] = $deviceType;
            if ($user->language !== $language && !empty($language)) $updates['language'] = substr($language, 0, 100);
            if ($referrer && $user->referrer !== $referrer) $updates['referrer'] = substr($referrer, 0, 500);

            if (!empty($updates)) {
                $user->update($updates);
            }
        }

        return $response;
    }

    private function isLocalIp(?string $ip): bool
    {
        if (empty($ip) || $ip === '127.0.0.1' || $ip === '::1') return true;
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false;
    }

    private function getBrowser(string $userAgent): string
    {
        if (preg_match('/edg/i', $userAgent)) return 'Microsoft Edge';
        if (preg_match('/chrome|crios/i', $userAgent)) return 'Google Chrome';
        if (preg_match('/firefox|fxios/i', $userAgent)) return 'Mozilla Firefox';
        if (preg_match('/safari/i', $userAgent) && !preg_match('/chrome/i', $userAgent)) return 'Apple Safari';
        if (preg_match('/opera|opr/i', $userAgent)) return 'Opera';
        if (preg_match('/msie|trident/i', $userAgent)) return 'Internet Explorer';
        return 'Unknown Browser';
    }

    private function getOS(string $userAgent): string
    {
        if (preg_match('/windows nt 10/i', $userAgent)) return 'Windows 10 / 11';
        if (preg_match('/windows nt 6.3/i', $userAgent)) return 'Windows 8.1';
        if (preg_match('/windows nt 6.2/i', $userAgent)) return 'Windows 8';
        if (preg_match('/windows nt 6.1/i', $userAgent)) return 'Windows 7';
        if (preg_match('/windows/i', $userAgent)) return 'Windows';
        if (preg_match('/android/i', $userAgent)) return 'Android';
        if (preg_match('/iphone|ipad|ipod/i', $userAgent)) return 'iOS';
        if (preg_match('/mac os x/i', $userAgent)) return 'macOS';
        if (preg_match('/linux/i', $userAgent)) return 'Linux';
        return 'Unknown OS';
    }

    private function getDeviceType(string $userAgent): string
    {
        if (preg_match('/tablet|ipad/i', $userAgent)) return 'Tablet';
        if (preg_match('/mobile|iphone|ipod|android/i', $userAgent)) return 'Mobile';
        return 'Desktop';
    }
}
