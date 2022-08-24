@extends('layouts.frontend')

@section('content')

    <div id="main" class="site-main">
        <div id="main-content" class="single-page-content">
            <div id="primary" class="content-area">
                <div id="content" class="page-content site-content single-post" role="main">
                    <!-- Home Page Top Part -->
                    <div class="row">
                        <div class=" col-xs-12 col-sm-12">
                            <div class="home-content">
                                <div class="row flex-v-align">

                                    <div class="col-sm-12 col-md-5 col-lg-5">
                                        <div class="home-photo">
                                            <div class="hp-inner" style="background-image: url(img/kabir-third.jpg);">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-7 col-lg-7">
                                        <div class="home-text hp-left">
                                            <div class="owl-carousel text-rotation">
                                                <div class="item">
                                                    <h4>Hi there, </h4>
                                                </div>
                                            </div>

                                            <h1>I'm Mahedi Hasan.</h1>

                                            <p>
                                                @php echo $settings['para1']; @endphp
                                            </p>

                                            <div class="home-buttons ">
                                                <a href="https://www.linkedin.com/in/mahehasan" target="_blank" class="btn btn-primary font-weight-bolder"><span>Linked</span><img
                                                        src="https://img.icons8.com/external-justicon-flat-justicon/14/000000/external-linkedin-social-media-justicon-flat-justicon.png"/></a>
                                                <a href="https://www.youtube.com/c/MahediKabir/featured" class="btn btn-secondary youtube-color" target="_blank"><img src="youtube.png"
                                                                                                                                                                      alt="Youtube">Youtube</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Home Page Top Part -->

                    <!-- Services -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-50"></div>

                            <div class="block-title">
                                <h2 class="text-capitalize">Few facts about me</h2>
                            </div>

                            <div>
                                @php echo $settings['fewFactsAboutMe']; @endphp
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-50"></div>

                            <div class="block-title">
                                <h2 class="text-capitalize">Education</h2>
                            </div>

                            <div>
                                @php echo $settings['education']; @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
