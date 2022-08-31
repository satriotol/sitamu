@extends('layout.master')
@section('content')
    <x-app-layout>
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
                        <div class="mb-3">
                            <div class="form-group">

                                <label for="name" class="form-label">Permission</label> <br>
                                <div class="form-check corm-check-inline">
                                    <label class="form-check-label" for="checkAll">Select All</label>
                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                </div>
                                @empty($role)
                                    <div class="row">
                                        @foreach ($permission as $value)
                                            <div class="col-md-3">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        {{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name form-check-input']) }}
                                                        {{ $value->name }}</label>
                                                    <br />
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endempty
                                @isset($role)
                                    <div class="row">
                                        @foreach ($permission as $value)
                                            <div class="col-md-3">
                                                <div class="form-check form-check-inline">
                                                    <label
                                                        class="form-check-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name form-check-input']) }}
                                                        {{ $value->name }}</label>
                                                    <br />
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endisset
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 text-right">
                                <a href="{{ URL::previous() }}" class="btn btn-warning">Batal</a>
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
        @push('scripts')
            <script>
                $("#checkAll").click(function() {
                    $('.name').not(this).prop('checked', this.checked);
                });
            </script>
        @endpush
    </x-app-layout>
@endsection
