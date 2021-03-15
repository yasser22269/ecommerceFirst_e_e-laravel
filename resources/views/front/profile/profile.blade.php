@extends('layouts.app')
@section('title','profile')

@section('content')


<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-12 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <div class="page-banner">
                    <h1>profile</h1>
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('home') }}">HOME</a></li>
                            <li><a href="{{ route('profile') }}">profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

<div class="login-section section mt-20 mb-20">
    <div class="container">
        <div class="row">

            <!-- Login -->
            <div class="col-md-6 col-12 d-flex">
                <div class="ee-login">

                    <h3>My Profile</h3>

                    <!-- Login Form -->
    <form method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}" >
                        <div class="row">
                            <div class="col-12 mb-30">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Type your name address"name="name" value="{{ $user->name }}"  autocomplete="name" autofocus required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                 @enderror
                            </div>
                            <div class="col-12 mb-30">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Type your email address"name="email" value="{{ $user->email }}"  autocomplete="email" autofocus required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                 @enderror
                            </div>
                            <div class="col-12 mb-20">
                                <input type="password"class="form-control @error('password') is-invalid @enderror"  placeholder="Enter your passward" name="password"  >
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror

                            </div>
                            <div class="col-12 mb-20">
                                <input type="password"class="form-control @error('password_confirmation') is-invalid @enderror"  placeholder="Enter your passward confirmation" name="password_confirmation"  >
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror

                            </div>

                            <div class="col-12"><input type="submit" value="Save"></div>
                        </div>


                </div>
            </div>

            <div class="col-md-1 col-12 d-flex">

                <div class="login-reg-vertical-boder"></div>

            </div>
            <div class="col-md-5 col-12 d-flex">

                <div class="ee-account-image">
                    <h3>Upload your Image</h3>

                    <img src="{{ asset('images/Avatars/'. $user->avatar ) }}" alt="Account Image Placeholder" class="image-placeholder">

                    <div class="account-image-upload">
                        <input type="file" name="avatar" id="account-image-upload">
                        <label class="account-image-label" for="account-image-upload">Choose your image</label>
                    </div>

                    <p>jpEG 250x250</p>

                </div>

            </div>
                            {{-- <div class="col-12"><input type="submit" value="Save"></div> --}}

    </form>
        </div>
    </div>
</div>
@endsection
