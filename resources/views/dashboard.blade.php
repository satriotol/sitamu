@extends('layout.master')
@section('content')
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="container py-3">
                    @can('dashboard_admin')
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3 h-100">
                                    <div class="row">
                                        <div class="col-md-6 text-center">
                                            <i class="fa-solid fa-user-gear" style="font-size: 50px;"></i>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-muted" style="font-size: 10px;">Admin</p>
                                            <h1 style="font-size: 30px;">{{ $admin }}</h1>
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
                                            <h1 style="font-size: 30px;">{{ $user }}</h1>
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
                                            <h1 style="font-size: 30px;">{{ $user_need }}</h1>
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
                                            <h1 style="font-size: 30px;">{{ $cctv }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <canvas id="myChart" class="mt-3"></canvas>
                    @endcan
                    @can('dashboard_visitor')
                        @include('partials.errors')
                        <form class="w-full" action="{{ route('user_need.visitor') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>
                                    Keperluan
                                </label>
                                <input value="{{ old('name') }}" name="name" required class="form-control" type="text"
                                    placeholder="Keperluan">
                            </div>
                            <div class="form-group">
                                <label>Upload Foto Selfie</label>
                                <input type="file" name="image" class="form-control" required accept="image/*">
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3 text-right">
                                    <button type="submit"
                                        class=" shadow-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Save Kunjungan Tamu
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endcan
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const labels = [
                    @foreach ($data_week['params'] as $key => $params)
                        '{{ $params }}',
                    @endforeach
                ];

                const data = {
                    labels: labels,
                    datasets: [{
                        label: '{{ $data_week['thisMonth'] }}',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: [
                            @foreach ($data_week['data'] as $key => $data)
                                '{{ $data }}',
                            @endforeach
                        ],
                    }]
                };

                const config = {
                    type: 'line',
                    data: data,
                    options: {}
                };
            </script>
            <script>
                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );
            </script>
        @endpush
    </x-app-layout>
@endsection
