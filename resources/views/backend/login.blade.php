@include('backend.layout.head')
<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4 pe-md-0">
                                <div class="auth-side-wrapper">
                                    {{-- <img src="{{ asset('backend/assets/images/IMG_1625(1).JPG') }}" alt=""> --}}
                                </div>
                            </div>
                            <div class="col-md-8 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="noble-ui-logo d-block mb-2">Hotel<span>Mitra</span></a>
                                    <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" :value="__('Email')" class="form-label">Email
                                                address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                :value="old('email')" required autofocus autocomplete="username"
                                                placeholder="Email">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" :value="__('Password')"
                                                class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password"
                                                autocomplete="current-password" placeholder="Password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                        <div>
                                            <button class="btn btn-primary me-2 mb-2 mb-md-0 text-white"
                                                type="submit">Login
                                            </button>
                                        </div>
                                        <a href="/register" class="d-block mt-3 text-muted">Not a user? Sign up</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('backend.layout.footer')