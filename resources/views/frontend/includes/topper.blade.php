<div class="top-bar main-color-background visible-md visible-lg">
    <div class="container">
        <div class="row">

            <div class="col-md-6">

                <ul class="list-inline social-top tt-animate btt">
                    @if(!empty($settings['facebook']))
                        <li ><a  href="{{$settings['facebook']}}"><i style="color: white" class="fa fa-facebook"></i></a></li>
                    @endif
                    @if(!empty($settings['twitter_page']))
                        <li><a href="{{$settings['twitter_page']}}"><i style="color: white" class="fa fa-twitter"></i></a></li>
                    @endif
                    @if(!empty($settings['linked_in']))
                        <li><a href="{{$settings['linked_in']}}"><i style="color: white" class="fa fa-linkedin"></i></a></li>
                    @endif
                    @if(!empty($settings['youtube_site']))
                        <li><a href="{{$settings['youtube_site']}}"><i style="color: white" class="fa fa-youtube"></i></a></li>
                    @endif
                </ul>
            </div>
            <div class="col-md-6 text-right">
                <ul class="topbar-cta no-margin">
                    <li class="mr-20">
                        <a href="mailto:{{$settings['website_email']}}"><i class="material-icons mr-10">&#xE0B9;</i>{{$settings['website_email']}}</a>
                    </li>
{{--                    <li>
                        <a href="callto:{{$settings['contact_phone']}}"><i class="material-icons mr-10">&#xE0CD;</i> {{$settings['contact_phone']}}</a>
                    </li>--}}
                </ul>
            </div>
        </div>
    </div>
</div>
