@extends('layout.master')
@section('content')
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-10">
                    <a href="{{ route('cctv.create') }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                        + Create CCTV
                    </a>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-5 table-responsive">
                        <table id="dataTableExample" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cctvs as $cctv)
                                    <tr>
                                        <td>{{ $cctv->url }}</td>
                                        <td><a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                                                href="{{ route('cctv.edit', $cctv->id) }}">
                                                Edit
                                            </a>
                                            <form class="inline-block" action='{{ route('cctv.destroy', $cctv->id) }}'
                                                method="POST">
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
                <h3 class="mt-3">Tutorial Penggunaan</h3>
                <iframe width="50%"
                    src="https://docs.google.com/document/d/e/2PACX-1vQ4DLEVlEEhfIptn_CWKhI9kZ3vZ4Z1_5M1h8hv5FfwVuVOIdh9bDBHHra8eqhm6QzmX22pTj7DWeNE/pub?embedded=true"></iframe>
            </div>
        </div>
    </x-app-layout>
@endsection
