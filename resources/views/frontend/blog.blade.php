@extends('layouts.frontend')

@section('content')
    <div id="main" class="site-main">
        <div id="main-content" class="single-page-content">
            <div id="primary" class="content-area">

                <div class="page-title">
                    <h1>Blog</h1>
                    <div class="page-subtitle">
                        <h4> My Diary</h4>
                    </div>
                </div>

                <div id="content" class="page-content site-content single-post" role="main">

                    <div class="row">
                        <div class=" col-xs-12 col-sm-12 ">

                            <div class="blog-masonry three-columns clearfix lazy">
                                @foreach($posts as $post)
                                <div class="item">
                                    <div class="blog-card">
                                        <div class="media-block">
                                            <a href="{{route('blogshow', $post->slug)}}">
                                                <img src="{{asset('/storage/image/'.$post->image)}}" alt="{{$post->title}}" />
                                                <div class="mask"></div>
                                            </a>
                                        </div>
                                        <div class="post-info">
                                            <div class="post-date">{{$post->created_at}}</div>
                                            <a href="{{route('blogshow', $post->slug)}}">
                                                <h4 class="blog-item-title">{{$post->title}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
