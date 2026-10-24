@props(['status'])

@php
    $labels = [
        'active' => 'Aktif',
        'inactive' => 'Nonaktif',
        'graduated' => 'Lulus',
    ];

    $classes = [
        'active' => 'badge-active',
        'inactive' => 'badge-inactive',
        'graduated' => 'badge-graduated',
    ];

    $statusKey = (string) ($status ?? 'active');
    $label = $labels[$statusKey] ?? ucfirst($statusKey);
    $badgeClass = $classes[$statusKey] ?? 'badge-graduated';
@endphp

<span class="badge {{ $badgeClass }}">{{ $label }}</span>
