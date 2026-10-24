<?php

namespace App\Http\Middleware;

use App\Services\DeviceDetector;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class DetectDeviceMiddleware
{
    public function __construct(
        protected DeviceDetector $detector
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $deviceType = $this->detector->detect($request);
        $isMobile = $deviceType === 'mobile';
        $override = $request->session()->get('device_override');

        $request->attributes->set('deviceType', $deviceType);
        $request->attributes->set('isMobile', $isMobile);

        View::share('deviceType', $deviceType);
        View::share('isMobile', $isMobile);
        View::share('deviceOverride', $override);

        return $next($request);
    }
}
