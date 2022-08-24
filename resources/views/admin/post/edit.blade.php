@extends('layouts.admin-master')
@section('title')
    Update Press Release
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <p class="pull-right"><a href="{{route('post.index')}}">
                    <button type="button" class="btn btn-primary waves-effect w-md waves-light m-b-5">View Press Release
                    </button>
                </a></p>
            <div class="card-box table-responsive">
                <x-alert/>
                <form method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label">Title<span style="color: red"> *</span></label>
                            <input type="text" name="title" value="{{$post->title}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Featured Image</label><br>
                            <input type="file" value="{{$post->image}}" name="image">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Publish Policy<span style="color: red"> *</span></label><br>
                            <select name="published" class="form-control select">
                                <option value="yes" @if($post->published == 'yes') {{"selected"}} @endif>Published</option>
                                <option value="draft" @if($post->published == 'draft') {{"selected"}} @endif>Draft</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label">Description</label>
                            <textarea class="elm1" name="body">{{$post->body}}</textarea>
                        </div>
                    </div>
                    <input type="submit" name="update" value="Update" class="btn btn-primary"
                           class="btn btn-primary form-control">
                    <input type="submit" name="stay" value="Update &amp; Stay" class="btn btn-success"
                           class="btn btn-pink form-control">
                </form>
            </div>

        </div>
    </div>
@endsection
