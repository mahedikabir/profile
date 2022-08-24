@extends('layouts.admin-master')
@section('title')
    Create Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <p class="pull-right"><a href="{{route('admin.index')}}">
                    <button type="button" class="btn btn-primary waves-effect w-md waves-light m-b-5">View Admin
                    </button>
                </a></p>
            <div class="card-box table-responsive">
                <x-alert/>
                <form method="post" action="{{route('admin.store')}}" enctype="multipart/form-data">
                    @csrf
                    <code>Email Should be Unique (One for one user)</code>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{ __('Name') }} <span style="color: red"> *</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{ __('E-Mail Address') }}<span style="color: red"> *</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <code>Password atLeast [8 Character, a special character, one digit, one uppercase letter, one lowercase letter]</code>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{ __('Password') }}<span style="color: red"> *</span></label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{ __('Confirm Password') }}<span style="color: red"> *</span></label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{ __('Phone') }}</label>
                            <input  type="text"
                                   class="form-control"  name="phone"
                                   >
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{ __('Position') }}</label>
                            <input type="text" class="form-control"
                                   name="position">
                        </div>
                    </div>

                    <input type="submit" name="save" value="Save" class="btn btn-primary"
                           class="btn btn-primary form-control">
                    <input type="submit" name="more" value="Save &amp; Add More" class="btn btn-purple"
                           class="btn btn-primary form-control">
                </form>
            </div>
        </div>
    </div>
@endsection
