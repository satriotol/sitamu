<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container py-3">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3 h-100">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <i class="fa-solid fa-user-gear" style="font-size: 50px;"></i>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted" style="font-size: 10px;">Admin</p>
                                    <h1 style="font-size: 30px;">{{$admin}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3 h-100">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <i class="fa-solid fa-user align-middle" style="font-size: 50px;"></i>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted" style="font-size: 10px;">Akun Pengunjung</p>
                                    <h1 style="font-size: 30px;">{{$user}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3 h-100">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <i class="fa-solid fa-glasses" style="font-size: 50px;"></i>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted" style="font-size: 10px;">Kunjungan Tamu</p>
                                    <h1 style="font-size: 30px;">{{$user_need}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3 h-100">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <i class="fa-solid fa-video" style="font-size: 50px;"></i>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted" style="font-size: 10px;">CCTV</p>
                                    <h1 style="font-size: 30px;">{{$cctv}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    @endpush
</x-app-layout>
