@extends('layouts.master');
@section('title')
@lang('lang.users.info')
@endsection
@section('content')
<div class="box card-inverse bg-img" style="background-image: url({{asset('images/gallery/full/2.jpg')}}); padding-top: 150px">
    <div class="flexbox align-items-center px-20" data-overlay="4">
      <div class="flexbox align-items-center mr-auto">
        <a href="#">
          <img class="avatar avatar-xl avatar-bordered" src="{{$data['avatar']}}" alt="">
        </a>
        <div class="pl-10 d-none d-md-block">
          <h5 class="mb-0"><a class="hover-primary text-white" href="#">{{$data['full_name']}}</a></h5>
          <span>({{$data['user_name']}})</span>
        </div>
      </div>
    </div>
  </div>
<!-- Profile Image -->
<div class="box">
  <div class="box-body box-profile">            
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="profile-user-info">
                <p>@lang('lang.users.email') :<span class="text-gray pl-10">{{$data['email']}}</span> </p>
                <p>@lang('lang.users.user_name') :<span class="text-gray pl-10">{{$data['user_name']}}</span></p>
                <p>@lang('lang.users.full_name') :<span class="text-gray pl-10">{{$data['full_name']}}</span></p>
            </div>
            <div class="profile-user-info mt-25">		
              <div class="user-social-acount">
                <a href="#" class="btn btn-warning">@lang('lang.common.exit')</a>
                <a href="{{route('users.edit')}}" class="btn btn-primary">@lang('lang.common.edit')</a>
              </div>
          </div>
       </div>
        <div class="col-md-6 col-12">
            <div class="profile-user-info">
                <p>@lang('lang.users.address') :<span class="text-gray pl-10">{{$data['address']}}</span></p>
                <p>@lang('lang.users.created_at') :<span class="text-gray pl-10">{{$data['created_at']}}</span></p>
            </div>
       </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection