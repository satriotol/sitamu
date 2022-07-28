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
                            Nama
                        </label>
                        <input value="{{ isset($user_detail) ? $user_detail->user->name : old('name') }}" name="name"
                            required class="form-control" type="text" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label>
                            Email
                        </label>
                        <input value="{{ isset($user_detail) ? $user_detail->user->email : old('email') }}" name="email"
                            required class="form-control" type="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>
                            Password
                        </label>
                        <input name="password" class="form-control" type="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>
                            Telepon
                        </label>
                        <input value="{{ isset($user_detail) ? $user_detail->phone : old('phone') }}" name="phone"
                            required class="form-control" type="text" placeholder="Telepon">
                    </div>
                    <div class="form-group">
                        <label>
                            Instansi
                        </label>
                        <input value="{{ isset($user_detail) ? $user_detail->instansi : old('instansi') }}" name="instansi"
                            required class="form-control" type="text" placeholder="Instansi">
                    </div>
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
