@extends('layouts.admin-master')
@section('title')
    Update Admin
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
                <form method="post" action="{{route('admin.update', $admin->id)}}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <code>Email Should be Unique (One for one user)</code>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{ __('Name') }}<span style="color: red"> *</span></label>
                            <input  id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{$admin->name}}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{ __('E-Mail Address') }}<span style="color: red"> *</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ $admin->email}}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{ __('Phone') }}</label>
                            <input type="text" value="{{$admin->phone}}"
                                   class="form-control" name="phone">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{ __('Position') }}</label>
                            <input type="text" class="form-control" value="{{$admin->position}}"
                                   name="position">
                        </div>
                    </div>
                    <input type="submit" name="update" value="Update" class="btn btn-primary"
                           class="btn btn-primary form-control">
                    <input type="submit" name="stay" value="Update &amp; Stay" class="btn btn-success"
                           class="btn btn-primary form-control">
                </form>
            </div>

        </div>
    </div>
@endsection
