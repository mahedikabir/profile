<div class="row">
    <div class="col-md-12">
        <div class="border-tab primary-nav">

            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active"><a href="#tab-10" class="waves-effect waves-light" role="tab" data-toggle="tab">About us</a></li>
                <li role="presentation"><a href="#tab-11" class="waves-effect waves-light" role="tab" data-toggle="tab">Recent Programs</a></li>
                <li role="presentation"><a href="#tab-12" class="waves-effect waves-light" role="tab" data-toggle="tab">Activities</a></li>
                <li role="presentation"><a href="#tab-13" class="waves-effect waves-light" role="tab" data-toggle="tab">Objectives</a></li>
            </ul>

            <div class="panel-body">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="tab-10">
                        <div class="row">
                            <div class="col-md-10">
                                @php echo $settings['home_about_us'] @endphp
                            </div>
                            <div class="col-md-2">
                                <img src="{{asset('/storage/image/'.$settings['website_logo'])}}"
                                     alt="{{$settings['website_title']}}" width="150"
                                     class="img-responsive">
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-11">
                        <div class="col-md-6">
                            <ul>
                                @foreach($programChunks[0] as $program)
                                    @if(!empty($program->link))
                                        <a style="color: black;" href="{{$program->link}}"><li>{{$program->title}}</li></a>
                                    @else
                                        <li>{{$program->title}}</li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                @foreach($programChunks[1] as $program)
                                    @if(!empty($program->link))
                                        <a href="{{$program->link}}"><li>{{$program->title}}</li></a>
                                    @else
                                        <li>{{$program->title}}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-12">
                        @php echo $settings['home_activity_press_club'] @endphp
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-13">
                        @php echo $settings['home_objectives'] @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
