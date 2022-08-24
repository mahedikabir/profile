@extends('layouts.admin-master')
@section('title')
    Change Password
@endsection

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card-box table-responsive">
                <div>
                    <p><b>Name: </b>{{Auth::user()->name}} <br>
                        <b>Phone: </b>{{Auth::user()->phone}}<br>
                        <b>Email: </b>{{Auth::user()->email}}<br>
                        <b> Position: </b>{{Auth::user()->position}}</p>
                </div>
                <x-alert/>
                <form method="post" action="{{route('passwordChange')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">


                        <h2>Change Password For {{Auth::user()->name}}</h2>

                        <div class="form-group col-md-12">
                            <label class="col-form-label">{{ __('Old Password') }}</label>
                            <input type="password"
                                   class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword">

                            @error('oldPassword')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <code>Password atLeast [8 Character, a special character, one digit, one uppercase letter, one lowercase letter]</code>
                        <div class="form-group col-md-12">
                            <label class="col-form-label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label class="col-form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <input type="submit" name="save" value="Save" class="btn btn-primary"
                           class="btn btn-primary form-control">
                </form>
            </div>
        </div>
    </div>
@endsection
