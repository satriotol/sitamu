@extends('layout.master')
@section('content')
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-10">
                    <a href="{{ route('user_need.create') }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                        + Create Kunjungan Tamu
                    </a>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-5 table-responsive">
                        <table id="dataTableExample" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Pengunjung</th>
                                    <th>Pendamping</th>
                                    <th>Keperluan</th>
                                    <th>Total Nilai</th>
                                    <th>Bukti</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user_needs as $user_need)
                                    <tr>
                                        <td>{{ $user_need->created_at }}</td>
                                        <td>{{ $user_need->user->name ?? '' }}</td>
                                        <td>{{ $user_need->guide_name }}</td>
                                        <td>{{ $user_need->name }}</td>
                                        <td>{{ $user_need->survey_answers->sum('value') }}</td>
                                        <td><img src="{{ asset('uploads/' . $user_need->image) }}" style="height: 100px"
                                                alt=""></td>
                                        <td><a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                                                href="{{ route('user_need.edit', $user_need->id) }}">
                                                Edit
                                            </a>
                                            <form class="inline-block"
                                                action='{{ route('user_need.destroy', $user_need->id) }}' method="POST">
                                                @method('delete')
                                                @csrf
                                                <button onclick="return confirm('Are you sure?')"
                                                    class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
                                                    Hapus
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endsection
