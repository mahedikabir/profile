@extends('layouts.admin-master')
@section('title')
    Admins
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <p class="pull-right"><a href="{{route('admin.create')}}">
                    <button type="button" class="btn btn-primary waves-effect w-md waves-light m-b-5">Create Admin
                    </button>
                </a></p>
            <div class="card-box table-responsive">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Position</th>
                        <th class="text-center">Modification</th>
                    </tr>
                    </thead>
                    <tbody>
                    <x-alert/>
                    @foreach($admin as $admins)
                        <tr>
                            <td>{{$admins->name}}</td>
                            <td> @if($admins->email != 'mahbubur.riad@gmail.com')
                                    {{$admins->email}}
                                @else
                                    {{$admins->email}} <span class="badge badge-success pull-right">Default</span>
                                @endif
                            </td>
                            <td>{{$admins->phone}}</td>
                            <td>{{$admins->position}}</td>

                            <td class="text-center">
                                @if($admins->email != 'mahbubur.riad@gmail.com')
                                    <a class="btn btn-primary waves-effect waves-light m-r-5 m-b-10"
                                       href="{{route('admin.edit',$admins->id)}}"><i class="fa fa-edit"></i></a>

                                    <span class="fa fa-trash btn btn-danger waves-effect waves-light m-r-5 m-b-10"
                                          onclick="event.preventDefault();
                                              if(confirm('Are you really want to delete?')){
                                              document.getElementById('form-delete-{{$admins->id}}')
                                              .submit()
                                              }"/>
                                    <form style="display:none" id="{{'form-delete-'.$admins->id}}" method="post"
                                          action="{{route('admin.destroy',$admins->id)}}">
                                        @csrf
                                        @method('delete')
                                    </form>
                                @else
                                    <span class="alert alert-danger">Not Changable</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
