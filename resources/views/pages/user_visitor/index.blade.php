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
                                    <th>Keperluan</th>
                                    <th>Bukti</th>
                                    <th>Acc By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user_needs as $user_need)
                                    <tr>
                                        <td>{{ $user_need->created_at }}</td>
                                        <td>{{ $user_need->user->name ?? '' }}</td>
                                        <td>{{ $user_need->name }}</td>
                                        <td><img src="{{ asset('uploads/' . $user_need->image) }}" alt=""></td>
                                        <td>
                                            @if ($user_need->admin_id)
                                                <span class="badge bg-success">{{$user_need->admin->name}}</span>
                                            @else
                                                <form class="inline-block"
                                                    action='{{ route('user_need.changeStatus', $user_need->id) }}'
                                                    method="POST">
                                                    @csrf
                                                    <button onclick="return confirm('Apakah Anda Yakin?')"
                                                        class="badge bg-danger">Belum Di
                                                        Acc</button>

                                                </form>
                                            @endif
                                        </td>
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
