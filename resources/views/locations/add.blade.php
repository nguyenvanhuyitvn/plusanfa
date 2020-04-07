@extends('layouts.master');
@section('title')
@lang('lang.common.add')
@endsection
@section('content')
<div class="col-lg-12 col-12">
    <div class="box box-solid bg-gray">
      <div class="box-header with-border">
        <h4 class="box-title">@lang('lang.location.add')</h4>			
          <ul class="box-controls pull-right">
            <li><a class="box-btn-slide" href="#"></a></li>	
            <li><a class="box-btn-fullscreen" href="#"></a></li>
          </ul>
      </div>
      <!-- /.box-header -->
      <form class="form" method="POST" action="{{route('location.store')}}" enctype="multipart/form-data">
        @csrf
          <div class="box-body">
              <h4 class="box-title text-info"><i class="ti-user mr-15"></i> @lang('lang.location.title')</h4>
              <hr class="my-15">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>@lang('lang.location.location_name')</label>
                    <input id="location_name" type="text" class="form-control @error('location_name') is-invalid @enderror" name="location_name" value="{{ old('user_name') }}" required placeholder="@lang('lang.location.location_name')" autofocus>
                    @error('location_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('lang.location.type')</label>
                        <select class="form-control @error('type') is-invalid @enderror" name="type" required>
                            @foreach($locationType as $type)  
                                <option value="{{$type['id_master']}}">{{$type['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
               
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('lang.location.detail')</label>
                      <input id="detail" type="text" class="form-control @error('detail') is-invalid @enderror" name="detail" value="{{ old('type') }}" required placeholder="@lang('lang.location.detail')" autofocus>
                      @error('detail')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
              </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
              <a href="{{route('location.index')}}" class="btn btn-warning mr-1" type="button">
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