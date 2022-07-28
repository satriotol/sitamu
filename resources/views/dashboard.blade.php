<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container py-3">
                    <video id="video" controls></video>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/hls.js@1"></script>
        <script>
            var video = document.getElementById('video');
            var videoSrc =
                'rtsp://admin:user1234@10.173.31.137:554/Streaming/Channels/101/';
            //
            // First check for native browser HLS support
            //
            if (video.canPlayType('application/vnd.apple.mpegurl')) {
                video.src = videoSrc;
                //
                // If no native HLS support, check if HLS.js is supported
                //
            } else if (Hls.isSupported()) {
                var hls = new Hls();
                hls.loadSource(videoSrc);
                hls.attachMedia(video);
            }
        </script>
    @endpush
</x-app-layout>
