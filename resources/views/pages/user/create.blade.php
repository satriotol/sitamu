@extends('layout.master')
@section('content')
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    @include('partials.errors')
                    <form class="w-full"
                        action="@isset($user) {{ route('user.update', $user->id) }} @endisset @empty($user) {{ route('user.store') }} @endempty"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($user))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label>
                                Nama
                            </label>
                            <input value="{{ isset($user) ? $user->name : old('name') }}" name="name" required
                                class="form-control" type="text" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label>
                                Phone
                            </label>
                            <input value="{{ isset($user) ? $user->phone : old('phone') }}" name="phone" required
                                class="form-control" type="text" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <label>
                                Email
                            </label>
                            <input value="{{ isset($user) ? $user->email : old('email') }}" name="email" required
                                class="form-control" type="text" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>
                                Password
                            </label>
                            <input value="" name="password" class="form-control" type="password"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" data-width="100%" required name="role">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        @isset($user) @if ($role->id === $user->roles[0]->id) selected @endif @endisset>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 text-right">
                                <a href="{{ URL::previous() }}" class="btn btn-warning">Batal</a>
                                <button type="submit"
                                    class=" shadow-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Save Admin
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
@endsection
