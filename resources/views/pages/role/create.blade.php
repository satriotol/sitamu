<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Admin &raquo; Create') !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @include('partials.errors')
                <form class="w-full"
                    action="@isset($role) {{ route('role.update', $role->id) }} @endisset @empty($role) {{ route('role.store') }} @endempty"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @if (isset($role))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label>
                            Nama
                        </label>
                        <input value="{{ isset($role) ? $role->name : old('name') }}" name="name" required
                            class="form-control" type="text" placeholder="Nama">
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit"
                                class=" shadow-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
