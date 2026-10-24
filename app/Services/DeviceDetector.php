<?php

namespace App\Services;

use Illuminate\Http\Request;

class DeviceDetector
{
    protected const MOBILE_REGEX = '/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i';

    public function detect(Request $request): string
    {
        $override = $this->resolveOverride($request);
        if ($override !== null) {
            return $override;
        }

        $userAgent = (string) $request->header('User-Agent', '');

        return preg_match(self::MOBILE_REGEX, $userAgent) ? 'mobile' : 'desktop';
    }

    public function isMobile(Request $request): bool
    {
        return $this->detect($request) === 'mobile';
    }

    private function resolveOverride(Request $request): ?string
    {
        if ($request->has('device')) {
            $deviceParam = strtolower((string) $request->query('device'));
            if (in_array($deviceParam, ['desktop', 'mobile'], true)) {
                $request->session()->put('device_override', $deviceParam);
                return $deviceParam;
            }

            if ($deviceParam === 'auto') {
                $request->session()->forget('device_override');
            }
        }

        $sessionOverride = $request->session()->get('device_override');
        if (in_array($sessionOverride, ['desktop', 'mobile'], true)) {
            return $sessionOverride;
        }

        return null;
    }
}
