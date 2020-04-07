@extends('layouts.master');
@section('title')
@lang('lang.common.edit')
@endsection
@section('content')
<div class="col-lg-12 col-12">
    <div class="box box-solid bg-gray">
      <div class="box-header with-border">
        <h4 class="box-title">@lang('lang.users.edit')</h4>			
          <ul class="box-controls pull-right">
            <li><a class="box-btn-slide" href="#"></a></li>	
            <li><a class="box-btn-fullscreen" href="#"></a></li>
          </ul>
      </div>
      <!-- /.box-header -->
      <form class="form" method="POST" action="{{route('users.update')}}" enctype="multipart/form-data">
        @csrf
          <div class="box-body">
              <h4 class="box-title text-info"><i class="ti-user mr-15"></i> @lang('lang.users.personal_info')</h4>
              <hr class="my-15">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>@lang('lang.users.user_name')</label>
                  <input type="text" name='user_name' class="form-control" placeholder="@lang('lang.users.user_name')" value="{{$data['user_name']}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>@lang('lang.users.full_name')</label>
                  <input type="text" name='full_name' class="form-control" placeholder="@lang('lang.users.full_name')" value="{{$data['full_name']}}">
                  </div>
                </div>
               
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label >@lang('lang.users.email')</label>
                  <input type="text" name='email' class="form-control" placeholder="@lang('lang.users.email')" value="{{$data['email']}}">
                  </div>
                </div>
               
                <div class="col-md-6">
                  <div class="form-group">
                    <label >@lang('lang.users.address')</label>
                    <input type="text" name='address' class="form-control" placeholder="@lang('lang.users.address')" value="{{$data['address']}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label >@lang('lang.users.old_password')</label>
                    <input type="password" name='oldPassword' class="form-control" placeholder="@lang('lang.users.old_password')">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label >@lang('lang.users.new_password')</label>
                    <input type="password" name='newPassword' class="form-control" placeholder="@lang('lang.users.new_password')">
                  </div>
                </div>
              </div>
              <h4 class="box-title text-info"><i class="ti-save mr-15"></i> @lang('lang.users.avatar')</h4>
              <hr class="my-15">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-12">
                    <label class="file">
                      <input type="file" name='avatar' id="avatar">
                    </label>
                    <div class="form-group">
                      @if (!empty($data['avatar']))
                        <img src="{{$data['avatar']}}" id="img-avatar" width="150px" height="150px"/>
                      @else
                        <img src="{{asset('images/avatar/no-avatar.png')}}" id="img-avatar" width="150px" height="150px"/>
                      @endif
                    </div>
                </div>
              </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
              <a href="{{route('users.index')}}" class="btn btn-warning mr-1" type="button">
                <i class="ti-trash"></i> Cancel
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="ti-save-alt"></i> Save
              </button>
          </div>  
      </form>
    </div>
    <!-- /.box -->			
</div>  
@endsection