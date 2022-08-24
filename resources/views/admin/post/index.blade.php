@extends('layouts.admin-master')
@section('title')
    Press Releases
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <p class="pull-right"><a href="{{route('post.create')}}">
                    <button type="button" class="btn btn-primary waves-effect w-md waves-light m-b-5">Create Posts
                    </button>
                </a></p>
            <div class="card-box table-responsive">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>image</th>
                        <th>Title</th>
                        <th>Publish</th>
                        <th class="text-center">Modification</th>
                    </tr>
                    </thead>
                    <tbody>
                    <x-alert/>
                    @foreach($post as $posts)
                        <tr>
                            <td> @if(!empty($posts->image)) <img width="80"
                                                                 src="{{asset('/storage/image/'.$posts->image)}}"
                                                                 alt="">  @endif</td>
                            <td>{{$posts->title}}</td>
                            <td>
                                @if($posts->published == 'yes')
                                    {{"Published"}}
                                @else
                                    {{"Draft"}}
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="btn btn-primary waves-effect waves-light m-r-5 m-b-10"
                                   href="{{route('post.edit',$posts->id)}}"><i class="fa fa-edit"></i></a>
                                <span class="fa fa-trash btn btn-danger waves-effect waves-light m-r-5 m-b-10"
                                      onclick="event.preventDefault();
                                          if(confirm('Are you really want to delete?')){
                                          document.getElementById('form-delete-{{$posts->id}}')
                                          .submit()
                                          }"/>
                                <form style="display:none" id="{{'form-delete-'.$posts->id}}" method="post"
                                      action="{{route('post.destroy',$posts->id)}}">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
