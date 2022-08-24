<div class="vertical-tab">
    <div class="row">
        <div class="col-sm-3">

            <ul class="nav nav-tabs nav-stacked" role="tablist">
                <li role="presentation" class="active"><a href="#tab-5" class="waves-effect waves-dark" role="tab" data-toggle="tab">About Us</a></li>
                <li role="presentation" ><a href="#tab-6" class="waves-effect waves-dark" role="tab" data-toggle="tab">Recent Programs</a></li>
                <li role="presentation"><a href="#tab-7" class="waves-effect waves-dark" role="tab" data-toggle="tab">Activities</a></li>
                <li role="presentation"><a href="#tab-8" class="waves-effect waves-dark" role="tab" data-toggle="tab">Objectives</a></li>
            </ul>
        </div>
        <div class="col-sm-9">

            <div class="panel-body">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="tab-5">

                        <div class="row">
                            <div class="col-md-10">
                                <h2 class="text-bold mb-40">About Us</h2>
                                @php echo $settings['home_about_us'] @endphp
                            </div>
                            <div class="col-md-2">
                                <img src="{{asset('/storage/image/'.$settings['website_logo'])}}"
                                     alt="{{$settings['website_title']}}" width="150"
                                     class="img-responsive">
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-6">
                        <h2 class="text-bold mb-40">Recent Programs</h2><br>
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
                    <div role="tabpanel" class="tab-pane fade" id="tab-7">
                        <h2 class="text-bold mb-40">Activities of Press Club Members</h2><br>
                        @php echo $settings['home_activity_press_club'] @endphp
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-8">
                        <h2 class="text-bold mb-40">Objectives</h2>
                        @php echo $settings['home_objectives'] @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
