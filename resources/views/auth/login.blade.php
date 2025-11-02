@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card" style="margin-top: 40px;">
                <div class="card-header text-center" style="background: rgb(94 0 0) none repeat scroll 0% 0%;color: #fff;">
                    <h2 style="font-size: 20px;font-weight: bold;border-bottom: 1px solid;padding: 7px 0px;">{{ __('SAFE') }}</h2>
                    <h4 style="font-size: 15px;font-weight: bold;">Login to start your session</h4>
                </div>

                <div class="card-body" style="text-align: center;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input placeholder="Mobile Number" id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary" style="font-size: 12px;font-weight: bold;">
                                    {{ __('LOGIN') }}
                                </button>
                            </div>
                        </div>
                    </form>


                </div>

            </div>
            <p style="font-size: 12px;font-weight: bold;text-align: right;"><span style="color: red;">&copy;</span> <span> Rashedul Raju</span></p>
        </div>
    </div>
</div>
@endsection
