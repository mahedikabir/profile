@extends('layouts.frontend')

@section('content')

    <div id="main" class="site-main">
        <div id="main-content" class="single-page-content">
            <div id="primary" class="content-area">
                <div id="content" class="page-content site-content" role="main">

                    <article class="post">

                        <header class="entry-header">

                            <h2 class="entry-title">{{$post->title}}</h2>
                            <div>{{$post->created_at->diffForHumans()}} , &nbsp; &nbsp;
                                <span class="author vcard">
                            <i class="fas fa-user"></i>
                            <span> Hasan Mahedi</span>
                                </span>
                            </div>
                        </header><!-- .entry-header -->

                        <div class="post-thumbnail">
                            <img class="mx-auto d-block" src="{{asset('/storage/image/'.$post->image)}}"
                                 alt="{{$post->title}}"/>
                        </div>

                        <div class="post-content">
                            <div class="entry-content">

                                <div class="row">
                                    <div class=" col-xs-12 col-sm-12 ">
                                        @php
                                            echo "$post->body"
                                        @endphp

                                    </div>
                                </div>

                            </div><!-- .entry-content -->

                            <div class="entry-meta entry-meta-bottom">
                                <div class="date-author">

                        <span class="entry-date">
                          <a href="#" rel="bookmark">
                            <i class="far fa-clock"></i>
                            <time class="entry-date" datetime="2020-04-04T08:29:37+00:00"> {{$post->created_at->format('l, jS F, Y')}}</time>
                          </a>
                        </span>

                                    <span class="author vcard">
                          <a class="url fn n" href="#" rel="author">
                            <i class="fas fa-user"></i>
                            <span> Hasan Mahedi</span>
                          </a>
                        </span>
                                </div>

                                <!-- Share Buttons -->
                                <div class="entry-share btn-group share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}"
                                       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                       class="btn" target="_blank" title="Share on Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>

                                    <a href="https://twitter.com/share?url={{ Request::fullUrl() }}"
                                       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                       class="btn" target="_blank" title="Share on Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>

                                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{ Request::fullUrl() }}"
                                       onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"
                                       class="btn" title="Share on LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>

                                    <a href="http://www.digg.com/submit?url={{ Request::fullUrl() }}"
                                       onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"
                                       class="btn" title="Share on Digg">
                                        <i class="fab fa-digg"></i>
                                    </a>
                                </div>
                                <!-- /Share Buttons -->
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>

@endsection
