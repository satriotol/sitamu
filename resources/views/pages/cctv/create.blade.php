@extends('layout.master')
@section('content')
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    @include('partials.errors')
                    <form class="w-full"
                        action="@isset($cctv) {{ route('cctv.update', $cctv->id) }} @endisset @empty($cctv) {{ route('cctv.store') }} @endempty"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($cctv))
                            @method('PUT')
                        @endif
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-last-name">
                                    Url
                                </label>
                                <input value="{{ isset($cctv) ? $cctv->url : old('url') }}" name="url" required
                                    class="form-control" id="grid-last-name" type="text" placeholder="URL">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 text-right">
                                <a href="{{ URL::previous() }}" class="btn btn-warning">Batal</a>
                                <button type="submit"
                                    class=" shadow-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Save CCTV
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>-
    </x-app-layout>
@endsection
