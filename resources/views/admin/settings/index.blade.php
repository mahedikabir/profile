@extends('layouts.admin-master')
@section('title')
    Settings
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <x-alert/>
                <h4 style="color: #007bff" class="m-t-0 header-title">Website Settings</h4>

                <form method="post" action="{{route('settings.update', 'data')}}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Website Title</label>
                            <input type="text" name="data[website_title]" class="form-control"
                                   value="{{$settings->website_title}}">

                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Website Email</label>
                            <input type="text" name="data[website_email]" class="form-control"
                                   value="{{$settings->website_email}}">
                        </div>

                        <div class="form-group col-md-3">
                            <label class="col-form-label">Contact No 1</label>
                            <input type="text" name="data[contact_phone]" class="form-control"
                                   value="{{$settings->contact_phone}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Contact No 2</label>
                            <input type="text" name="data[contact_phone2]" class="form-control"
                                   value="{{$settings->contact_phone2}}">
                        </div>

                    </div>

                    <h4 style="color: #007bff" class="m-t-0 header-title">Social Settings</h4>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Facebook Page</label>
                            <input type="text" name="data[facebook]" class="form-control"
                                   value="{{$settings->facebook}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Twitter Page</label>
                            <input type="text" name="data[twitter_page]" class="form-control"
                                   value="{{$settings->twitter_page}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Youtube</label>
                            <input type="text" name="data[youtube_site]" class="form-control"
                                   value="{{$settings->youtube_site}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Linked In</label>
                            <input type="text" name="data[linked_in]" class="form-control"
                                   value="{{$settings->linked_in}}">
                        </div>
                    </div>

                    <h4 style="color: #007bff" class="m-t-0 header-title">Others</h4>
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label class="col-form-label">Address</label>
                            <textarea name="data[chat_code]" id=""
                                      class="form-control">{{$settings->chat_code}}</textarea>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="col-form-label">Website Logo</label>
                            <input type="file" class="dropify" name="logo"
                                   data-default-file="{{'/storage/image/'.$settings->website_logo}}"
                                   wtx-context="CC40410F-6AA7-4EC1-AC73-83EC3313F3D2">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Website Favicon</label>
                            <input type="file" class="dropify" name="favicon"
                                   data-default-file="{{'/storage/image/'.$settings->favicon}}"
                                   wtx-context="CC40410F-6AA7-4EC1-AC73-83EC3313F3D2">
                        </div>
                    </div>

                    <h4 style="color: #007bff" class="m-t-0 header-title">Frontend Controller</h4>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label">I am Mahedi Hasan</label>
                            <textarea class="elm1" name="data[para1]">{{$settings->para1}}</textarea>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label">Few facts about me</label>
                            <textarea class="elm1" name="data[fewFactsAboutMe]">{{$settings->fewFactsAboutMe}}</textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label">Education</label>
                            <textarea class="elm1" name="data[education]">{{$settings->education}}</textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label">CONFERENCES & POSTER PRESENTATION</label>
                            <textarea class="elm1" name="data[conference]">{{$settings->conference}}</textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label">AWARDS</label>
                            <textarea class="elm1" name="data[awards]">{{$settings->awards}}</textarea>
                        </div>
                    </div>

                    <input type="submit" name="submit" value="Save Settings" class="btn btn-primary"
                           class="btn btn-primary form-control">
                </form>
            </div>
        </div>
    </div>
@endsection
