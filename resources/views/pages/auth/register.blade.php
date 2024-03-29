@extends('layout.master2')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pe-md-0">
                            <div class="auth-side-wrapper" style="background-image: url({{ asset('/1.png') }})">

                            </div>
                        </div>
                        <div class="col-md-8 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2">SITAMU</a>
                                <h5 class="text-muted fw-normal mb-4">Create a free account.</h5>
                                @foreach ($errors->all() as $key => $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <form class="forms-sample" method="POST" action="{{ route('register_post') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="userEmail" placeholder="Nmae"
                                            class="email" required name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="userEmail" placeholder="Email"
                                            class="email" required name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="userEmail" placeholder="Phone"
                                            class="phone" required name="phone">
                                    </div>
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Instansi</label>
                                        <input type="text" class="form-control" id="userEmail" placeholder="Instansi"
                                            class="instansi" required name="instansi">
                                    </div>
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="userPassword"
                                            autocomplete="current-password" placeholder="Password" required name="password">
                                    </div>
                                    <div>
                                        <button class="btn btn-primary me-2 mb-2 mb-md-0" type="submit">Register</button>
                                    </div>
                                    <a href="{{ route('login') }}" class="d-block mt-3 text-muted">Already a user?
                                        Sign in</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
