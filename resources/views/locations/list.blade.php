@extends('layouts.master');
@section('title')
@lang('lang.location.title')
@endsection
@section('content')
<div class="row ">
  <div class="col-lg-12 col-12">
    <div class="panel panel-default">
      <div class="panel-heading bg-primary p-10 text-white align-middle d-flex justify-content-between">
        <h4 class="box-title align-middle my-auto">@lang('lang.location.title')</h4>
        <a href="{{ route('location.create')}}" class="btn btn-success btn-sm align-self-center">@lang('lang.location.add')</a>
      </div>
      <div class="panel-body">
                <hr class="my-15">
                {{--  // Flex Box  --}}
                <div class="row flex-col-5">
                  @foreach($locations as $local)
                  <div class="custom-col-5" style="margin-bottom:10px;">
                     {{--  test  --}}
                      <div class="small-box bg-info location-home-box" >
                          <div class="inner">
                              <span><h3>{{ $local['count'] }}</h3>(Thiết bị)</span>
                              <p>{{ $local['location_name'] }}</p>
                          </div>
                          <div class="icon">
                              <img src="{{ $local['type']['icon'] }}" alt="" width="50px" height="50px" srcset="">
                          </div>
                          {{--  <a class="small-box-footer modal-device-btn text-center" data-toggle="modal" data-id="{{ $local['id'] }}" data-target="#modal-right">Xem thiết bị <i class="fa fa-arrow-circle-right"></i></a>  --}}
                          <div class="box box-primary box-slided-up-detail box-solid">
                              <div class="box-header with-border text-center">
                                <a class="small-box-footer text-center text-white" >Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                              <ul class="box-controls pull-right">
                                <li><a class="box-btn-slide-detail" href="#"></a></li>	
                              </ul>
                              </div>
                              <div class="box-body" style="display: none; padding-left: 2px;">
                                  <div class="card-title text-left"> <span>Name:</span> <span>{{$local['location_name']}} </span> </div>
                                  <div class="text-left"> <span>Detail:</span> <span>{{$local['detail']}}</span> </div>
                                  <div class="btn-detail" style="margin-top: 10px;">
                                      <input type="hidden" class="enroll-location" value="{{$Enroll_location}}" data-id="{{$local['id']}}">
                                      <a data-toggle="modal" class="btn btn-warning btn-outline btn-sm pull-left text-center edit-location-modal" data-target="#modal-center-location" data-id="{{ $local['id'] }}" ><i class="fa fa-edit" style="font-size: 24px; color: orange;"></i></a>
                                      <a href="{{route('location.delete', ['id'=>$local['id']])}}" class="btn btn-danger btn-outline btn-sm pull-right text-center btn-delete-location" data-id="{{ $local['id'] }}"><i class="fa fa-trash" style="font-size: 23px"></i></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                     {{--  ./test  --}}
                      {{--  <div class="card" style="">
                              <img class="card-img-top img-location" data-toggle="popover" data-content="And here's some amazing content. It's very engaging. Right?" src="{{$local['type']['icon']}}" alt="Card image cap">
                              <div class="card-body" style="padding-top: 0px; padding-bottom: 0px;">
                                  <h5 class="card-title text-center">{{$local['location_name']}}</h5>
                              </div>
                          <div class="box box-default box-slided-up-detail box-solid">
                              <div class="box-header with-border">
                              <span class="box-title">Detail</span>
                              <ul class="box-controls pull-right">
                                  <li><a class="box-btn-slide-detail" href="#"></a></li>	
                              </ul>
                              </div>
                              <div class="box-body" style="display: none; padding-left: 2px;">
                                  <div class="card-title text-left"> <span>Name:</span> <span>{{$local['location_name']}} </span> </div>
                                  <div class="text-left"> <span>Detail:</span> <span>{{$local['detail']}}</span> </div>
                                  <div class="btn-detail" style="margin-top: 10px;">
                                      <input type="hidden" class="enroll-location" value={!!$Enroll_location!!} data-id="{{$local['id']}}">
                                      <a data-toggle="modal" class="btn btn-warning btn-outline btn-sm pull-left text-center edit-location-modal" data-target="#modal-center-location" data-id="{{ $local['id'] }}" ><i class="fa fa-edit" style="font-size: 24px; color: orange;"></i></a>
                                      <a href="{{route('location.delete', ['id'=>$local['id']])}}" class="btn btn-danger btn-outline btn-sm pull-right text-center delete-location" data-id="{{ $local['id'] }}"><i class="fa fa-trash" style="font-size: 23px"></i></a>
                                  </div>
                              </div>
                          </div>
                      </div>  --}}
                  </div>
                  @endforeach	
                </div>
                {{--  // Flex box  --}}
        </div>
    </div>		
  </div>  
</div>
<!-- Modal -->
<div class="modal center-modal fade" id="modal-center-location" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="box-body">
                  <input type="hidden" value=""  id="modal-id">
                  <h4 class="box-title text-info"><i class="ti-user mr-15"></i> @lang('lang.location.title')</h4>
                  <hr class="my-15">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>@lang('lang.location.location_name')</label>
                        <input id="location_name" type="text" class="form-control @error('location_name') is-invalid @enderror" name="location_name" value="{{ old('location_name') }}" required placeholder="@lang('lang.location.location_name')" autofocus>
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
                            <select class="form-control @error('type') is-invalid @enderror" id="modal-type" value="" name="type" required>
                                {{-- @foreach($locationType as $type)  
                                    <option class="lc-option" value="{{$type['id_master']}}">{{$type['name']}}</option>
                                @endforeach --}}
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
      </div>
      <div class="modal-footer modal-footer-uniform">
        <button type="button" class="btn btn-bold btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-bold btn-primary float-right" id="update-location"> <i class="ti-save-alt"></i>Save changes</button>
        {{-- <a id="update-location" class="btn btn-primary float-right mr-1" type="button">
            <i class="ti-trash"></i> Save
        </a> --}}
      </div>
      <input type="hidden" id="locationJson" value="{{$locationJson}}">
  </div>
</div>

<!-- /.modal -->
 
@endsection

