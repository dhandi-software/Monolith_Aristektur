<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DevicePreviewController extends Controller
{
    public function __invoke(Request $request, string $mode): RedirectResponse
    {
        if (in_array($mode, ['desktop', 'mobile'], true)) {
            $request->session()->put('device_override', $mode);
        } elseif ($mode === 'auto') {
            $request->session()->forget('device_override');
        }

        return redirect()->back();
    }
}
