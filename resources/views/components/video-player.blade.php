@props(['videoPath' => null, 'videoLink' => null, 'streamUrl' => null, 'downloadUrl' => null])

@php
    $embedUrl  = null;
    $embedType = null; // 'iframe' | 'video'

    if ($videoLink) {
        // YouTube: youtube.com/watch?v=ID  or  youtu.be/ID
        if (preg_match('/(?:youtube\.com\/watch\?.*v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoLink, $m)) {
            $embedUrl  = 'https://www.youtube.com/embed/' . $m[1];
            $embedType = 'iframe';
        }
        // Google Drive: drive.google.com/file/d/ID/...
        elseif (preg_match('/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/', $videoLink, $m)) {
            $embedUrl  = 'https://drive.google.com/file/d/' . $m[1] . '/preview';
            $embedType = 'iframe';
        }
        // Other direct URL — try as native video
        else {
            $embedUrl  = $videoLink;
            $embedType = 'video';
        }
    }
@endphp

@if($videoPath)
    <video controls preload="metadata" class="w-full rounded-lg mb-sm max-h-80 bg-black">
        <source src="{{ $streamUrl }}">
    </video>
    <a href="{{ $downloadUrl }}"
       class="inline-flex items-center gap-xs text-label-sm text-primary font-medium hover:underline">
        <span class="material-symbols-outlined text-[16px]">download</span>
        Download video
    </a>

@elseif($videoLink)
    @if($embedType === 'iframe')
        <div class="aspect-video w-full mb-sm rounded-lg overflow-hidden bg-black">
            <iframe src="{{ $embedUrl }}"
                    class="w-full h-full"
                    allowfullscreen
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin">
            </iframe>
        </div>
    @else
        <video controls preload="metadata" class="w-full rounded-lg mb-sm max-h-80 bg-black">
            <source src="{{ $embedUrl }}">
        </video>
    @endif
    <a href="{{ $videoLink }}" target="_blank" rel="noopener"
       class="inline-flex items-center gap-xs text-label-sm text-sky-600 font-medium hover:underline">
        <span class="material-symbols-outlined text-[16px]">open_in_new</span>
        Open link
    </a>

@else
    <span class="text-label-sm text-secondary">(none)</span>
@endif
