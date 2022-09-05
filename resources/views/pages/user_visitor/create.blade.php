@extends('layout.master')
@section('content')
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    @include('partials.errors')
                    <form class="w-full"
                        action="@isset($user_need) {{ route('user_need.update', $user_need->id) }} @endisset @empty($user_need) {{ route('user_need.store') }} @endempty"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($user_need))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label>Pengunjung</label>
                            <select class="select2 form-control" data-width="100%" required name="user_id">
                                <option value="">Select Pengunjung</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        @isset($user_need) @if ($user->id === $user_need->user_id) selected @endif @endisset>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>
                                Keperluan
                            </label>
                            <input value="{{ isset($user_need) ? $user_need->name : old('name') }}" name="name" required
                                class="form-control" type="text" placeholder="Keperluan">
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        @isset($user_need)
                            <img src="{{ $user_need->image }}" style="height: 100px" alt="">
                        @endisset
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 text-right">
                                <a href="{{ URL::previous() }}" class="btn btn-warning">Batal</a>x
                                <button type="submit"
                                    class=" shadow-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Save Kunjungan Tamu
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
@endsection
