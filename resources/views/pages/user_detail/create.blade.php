<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Tamu &raquo; Create') !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @include('partials.errors')
                <form class="w-full"
                    action="@isset($user_detail) {{ route('user_detail.update', $user_detail->id) }} @endisset @empty($user_detail) {{ route('user_detail.store') }} @endempty"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @if (isset($user_detail))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label>
                            Keperluan
                        </label>
                        <input value="{{ isset($user_detail) ? $user_detail->name : old('name') }}" name="name"
                            required class="form-control" type="text" placeholder="Keperluan">
                    </div>
                    <div class="form-group">
                        <label>
                            Nama Pendamping
                        </label>
                        <input value="{{ isset($user_detail) ? $user_detail->guide_name : old('guide_name') }}"
                            name="guide_name" required class="form-control" type="text"
                            placeholder="Nama Pendamping">
                    </div>
                    <video src="https://streaming.cctvsemarang.katalisindonesia.com/live/5euomh9otpDm6BvlRHC8bppjIEMBQeUROGghC_Ud352XV13LvlVdwGgiJvvpN8jL9DwuiyyxmO7yw-zJCE5JCpXcWAoSvFmG.m3u8">
                        Your browser does not support the VIDEO tag and/or RTP streams.
                      </video>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit"
                                class=" shadow-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Save Tamu
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
