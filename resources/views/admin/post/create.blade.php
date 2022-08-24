@extends('layouts.admin-master')
@section('title')
    Create Press Release
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <p class="pull-right"><a href="{{route('post.index')}}">
                    <button type="button" class="btn btn-primary waves-effect w-md waves-light m-b-5">View Posts
                    </button>
                </a></p>
            <div class="card-box table-responsive">
                <x-alert/>
                <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label">Title<span style="color: red"> *</span></label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Featured Image</label><br>
                            <input type="file" name="image">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Publish Policy<span style="color: red"> *</span></label><br>
                            <select name="published" class="form-control select">
                                <option value="yes">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label">Description</label>
                            <textarea class="elm1" name="body"></textarea>
                        </div>
                    </div>
                    <input type="submit" name="save" value="Save" class="btn btn-primary"
                           class="btn btn-primary form-control">
                    <input type="submit" name="more" value="Save &amp; Add More" class="btn btn-purple" class="btn btn-primary form-control">
                </form>
            </div>

        </div>
    </div>
@endsection
