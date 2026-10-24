<div class="device-bar">
    <div class="device-bar-title">
        <span>Arsitektur Monolith: Device Switcher</span>
        <span class="device-bar-badge {{ $isMobile ? 'mobile' : 'desktop' }}">{{ $isMobile ? 'mobile' : 'desktop' }}</span>
        @if(session('device_override'))
            <span style="font-size: 0.75rem; color: #94a3b8;">(Override aktif: {{ session('device_override') }})</span>
        @endif
    </div>
    <div class="device-toggle-group">
        <a href="{{ route('device.switch', 'desktop') }}" class="device-toggle-item {{ (session('device_override') === 'desktop' || (!session('device_override') && !$isMobile)) ? 'active' : '' }}" title="Paksa tampilan Desktop">
            Desktop
        </a>
        <a href="{{ route('device.switch', 'mobile') }}" class="device-toggle-item {{ (session('device_override') === 'mobile' || (!session('device_override') && $isMobile)) ? 'active' : '' }}" title="Paksa tampilan Mobile">
            Mobile
        </a>
        <a href="{{ route('device.switch', 'auto') }}" class="device-toggle-item {{ empty(session('device_override')) ? 'active' : '' }}" title="Gunakan deteksi User-Agent otomatis">
            Auto
        </a>
    </div>
</div>
