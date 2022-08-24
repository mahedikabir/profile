<div class="row">
    <div class="col-md-12">
        <div class="icon-tab">
            <div class="text-center">
                <ul class="nav nav-pills" role="tablist">
                    <li role="presentation"><a href="#icontab-1" class="waves-effect waves-light" role="tab" data-toggle="tab"> <i class="material-icons">&#xE3B7;</i></a>
                    </li>
                    <li role="presentation" class="active"><a href="#icontab-2" class="waves-effect waves-light" role="tab" data-toggle="tab"> <i class="material-icons">&#xE7FD;</i></a></li>
                    <li role="presentation"><a href="#icontab-3" class="waves-effect waves-light" role="tab" data-toggle="tab"> <i class="material-icons">&#xE53B;</i></a>
                    <li role="presentation"><a href="#icontab-4" class="waves-effect waves-light" role="tab" data-toggle="tab"> <i class="material-icons">&#xE54B;</i></a>
                    </li>
                </ul>
            </div>

            <div class="panel-body mt-40">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade" id="icontab-1">
                        <div class="row">
                            <h2 class="text-bold mb-40">Recent Programs</h2>
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
                    </div>
                    <div role="tabpanel" class="tab-pane fade in active" id="icontab-2">

                        <div class="row">
                            <div class="col-md-10">
                                <h2 class="text-bold mb-40">About us</h2>
                                @php echo $settings['home_about_us'] @endphp
                            </div>
                            <div class="col-md-2">
                                <img src="{{asset('/storage/image/'.$settings['website_logo'])}}"
                                     alt="{{$settings['website_title']}}" width="150"
                                     class="img-responsive">
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="icontab-3">
                        <div class="row">
                            <h2 class="text-bold mb-40">Activities of Press club members </h2>
                            @php echo $settings['home_activity_press_club'] @endphp
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade in" id="icontab-4">

                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="text-bold mb-40">Objectives</h2>
                                @php echo $settings['home_objectives'] @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
