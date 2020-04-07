@extends('layouts.master');
@section('title')
Trang chủ
@endsection
@section('content')
<div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1 align-middle"><i class="fa fa-cog"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">CPU Traffic</span>
              <span class="info-box-number">
                10
                <small>%</small>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3 ">
            <span class="info-box-icon bg-danger elevation-1 d-flex justify-content-center align-items-center" ><i class="fa fa-thumbs-up"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Members</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
</div>
<div class="row">
    <div class="col-lg-6 col-md-12 col-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <div class="panel panel-default">
                <div class="panel-heading bg-primary p-10 text-white align-middle d-flex justify-content-between">
                  <h4 class="box-title align-middle my-auto"><i class="fa fa-laptop-house pr-5"></i>Khu vực</h4>
                  <a  class="btn btn-success btn-sm align-self-center btn-add-location-home" style="display: block;"><i class="fa fa-plus pr-1"></i>Thêm mới</a>
                  <a  class="btn btn-success btn-sm align-self-center btn-back-location-home" style="display: none;"><i class="fa fa-undo pr-1"></i>Quay lại</a>
                </div>
                <div class="panel-body">
                  <hr class="my-15">
                      <div class="row">
                          @if (session('notify'))
                            <div class="alert bg-success" role="alert">
                                    {!!session('notify')!!}
                            </div>
                          @endif
                      </div>
                      <div class="row" id="location-home-content">
                        <input type="hidden" id="locationTypeJson" value="{{$locationTypeJson}}">
                        <input type="hidden" id="locationsJson" value="{{$locationsJson}}">
                        @foreach ($locations as $local)
                            <div class="custom-col-4">
                                <div class="small-box bg-info location-home-box"  data-target="#modal-right-device-location" data-id="{{ $local['id'] }}"> 
                                   
                                      <div class="inner">
                                        <h3>{{ $local['count'] }}</h3>
                                        <p class="location-name-selected">{{ $local['location_name'] }}</p>
                                      </div>
                                      <div class="icon">
                                          <img src="{{ $local['type']['icon'] }}" class="location-home-img" alt="" width="50px" height="50px" srcset="">
                                      </div>
                                   {{--    <a class="small-box-footer modal-device-btn text-center" data-toggle="modal" data-id="{{ $local['id'] }}" data-target="#modal-right">Xem thiết bị <i class="fa fa-arrow-circle-right"></i></a> --}}
                                      {{-- button --}}
                                      <div class="location-action-edit-delete text-center">
                                        <ul>
                                          <li>
                                            <a class="btn-location-edit" data-id = "{{ $local['id'] }}">
                                              <i class="fa fa-edit text-warning text-center"></i>
                                            </a>
                                          </li>
                                          <li>
                                            <a href="{{route('location.delete', ['id'=>$local['id']])}}" class="btn btn-danger btn-outline btn-sm text-center delete-location" data-id="{{ $local['id'] }}"><i class="fa fa-trash"></i></a>
                                          </li>
                                        </ul>
                                      </div>
                                      {{-- ./button --}}
                                </div>
                            </div>
                        @endforeach
                      </div>
                      {{-- Add new location --}}
                      <div class="row d-none" id="add-location-home-content">
                          <div class="col-md-12">
                            <form class="form" method="POST" action="{{route('location.store')}}" enctype="multipart/form-data">
                            @csrf
                              <div class="box-body">
                                  <h4 class="box-title text-info"><i class="ti-user mr-15"></i> @lang('lang.location.title')</h4>
                                  <hr class="my-15">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>@lang('lang.location.location_name')</label>
                                        <input id="location_name" type="text" class="form-control @error('location_name') is-invalid @enderror" name="location_name" value="{{ old('user_name') }}" placeholder="@lang('lang.location.location_name')" autofocus>
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
                                  <a class="btn btn-warning btn-add-location-cancel mr-1" type="button">
                                    <i class="ti-trash"></i> Cancel
                                  </a>
                                  <button type="submit" class="btn btn-primary">
                                    <i class="ti-save-alt"></i> Save
                                  </button>
                              </div>  
                          </form>
                          </div>
                      </div>
                      {{-- ./Add new location --}}
                       {{-- Edit location --}}
                      <div class="row d-none" id="edit-location-home-content">
                          <div class="col-md-12">
                            <form class="form" id="edit-location-home-form" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                              <div class="box-body">
                                  <h4 class="box-title text-info"><i class="ti-user mr-15"></i> Sửa khu vực</h4>
                                  <hr class="my-15">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>@lang('lang.location.location_name')</label>
                                        <input id="edit_location_name" type="text" class="form-control @error('location_name') is-invalid @enderror" name="location_name" value="" required placeholder="@lang('lang.location.location_name')" autofocus>
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
                                            <select class="form-control @error('type') is-invalid @enderror" id="edit-location-type" name="type" required>
                                               
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
                                          <input id="edit_location_detail" type="text" class="form-control @error('detail') is-invalid @enderror" name="detail" value="" required placeholder="@lang('lang.location.detail')" autofocus>
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
                                  <a class="btn btn-warning btn-edit-location-cancel mr-1" type="button">
                                    <i class="ti-trash"></i> Cancel
                                  </a>
                                  <button type="submit" class="btn btn-primary">
                                    <i class="ti-save-alt"></i> Save
                                  </button>
                              </div>  
                          </form>
                          </div>
                      </div>
                      {{-- ./Edit location --}}
                  </div>
              </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-12 device-area">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
          <div class="panel panel-default">
            <div class="panel-heading bg-primary p-10 text-white align-middle d-flex justify-content-between">
              <h4 class="box-title align-middle my-auto"><i class="fa fa-network-wired pr-5"></i>Thiết bị 
                <span class="device-belong-to-location" ></span>
                <span class="device-selected" ></span>
              </h4>
              {{-- <a  class="btn btn-success btn-sm align-self-center btn-add-location-home" style="display: block;"><i class="fa fa-plus pr-1"></i>Thêm mới</a> --}}
              {{-- <a  class="btn btn-success btn-sm align-self-center btn-back-device-home" style="display: none;"><i class="fa fa-undo pr-1"></i>Quay lại</a> --}}
            </div>
            <div class="panel-body">
              <hr class="my-15">
                  <div class="row device-selected-by-location-home">
                      <div class="custom-col-4">
                        <div class="card device-home-box" data-id="{{ $displayDeviceFirst['device_id']['id']}}" data-toggle="" data-target="#modal-right">
                          <img class="card-img-top" src="{{$displayDeviceFirst['device_id']['type']['icon']}}" width="35px" height="100px" alt="device">
                          <div class="card-body body-device">
                            <h5 class="card-title text-center device-name-selected">{{ $displayDeviceFirst['nickname_device']}}</h5>
                            <p class="card-text text-center"><i class="fas fa-power-off pr-2"></i> <i class="fas fa-power-off pr-2"></i> <i class="fas fa-power-off"></i></p>
                          </div>
                        </div>
                      </div>
                  </div>

                  {{-- Control Device Screen --}}
                  <div class="row control-device-screen d-none">
                      <div class="col-md-12">
                        <div class="box box-outline-primary">
                            <div class="box-header with-border">
                              <h4 class="box-title"><strong class="device-control-name" style="padding-left: 10px;">Thiết bị</strong></h4>
                              <div class="box-tools pull-right">          
                                <ul class="box-controls">
                                  <li><a class="box-btn-close" href="#"></a></li>
                                </ul>
                              </div>
                            </div>

                            <div class="box-body">
                              <div class="box box-transparent no-shadow">
                                  <!-- Nav tabs -->
                                  <ul class="nav nav-tabs nav-fill" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#device-control" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="fas fa-keyboard text-success"></i></span> <span class="hidden-xs-down">Điều khiển</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#schedule-device" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="fas fa-calendar-alt text-danger"></i></span> <span class="hidden-xs-down">Lịch</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#setting-device" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="fas fa-cogs text-warning"></i></span> <span class="hidden-xs-down">Cài đặt</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#share-device" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="fas fa-share-alt" style="color: orange;"></i></span> <span class="hidden-xs-down">Chia sẻ</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#history-device" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="fas fa-history" style="color: purple;"></i></span> <span class="hidden-xs-down">Lịch sử</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#update-device" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="fas fa-undo"></i></span> <span class="hidden-xs-down">Hành động</span></a> </li>
                                  </ul>
                                  <!-- Tab panes -->
                                  <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active show" id="device-control" role="tabpanel">
                                      <div class="pad">
                                        <h3>Điều khiển:</h3>
                                        <div class="clearfix d-flex flex-row justify-content-center">
                                            <div class="item-button">
                                              <button class="btn btn-social-icon btn-circle btn-secondary" style="margin: 0 10px;"><i class="fas fa-power-off"></i></button>
                                              <p>13:29:16</p>
                                            </div>
                                            <div class="item-button">
                                              <button class="btn btn-social-icon btn-circle btn-warning" style="margin: 0 10px;"><i class="fas fa-power-off"></i></button>
                                              <p>13:29:16</p>
                                            </div>
                                            <div class="item-button">
                                              <button class="btn btn-social-icon btn-circle btn-warning" style="margin: 0 10px;"><i class="fas fa-power-off"></i></button>
                                              <p>13:29:16</p>
                                            </div>
                                        </div>
                                        <div class="btn-bottom-control d-flex flex-row justify-content-around mt-5">
                                          <div class="btn-device-turn-all">
                                              <button type="button" class="btn btn-outline btn-warning mb-5">ON/OFF</button>
                                          </div>
                                          <div class="btn-device-favorite">
                                              <button type="button" class="btn btn-outline btn-success mb-5">Hay dùng</button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="pad">
                                        <h3>Lịch sử: </h3>
                                        <div class="clearfix" style="padding-left: 30px;">
                                            <div class="history-row">
                                                <span class="history-time">06/04/2020 15:02 CH</span> <span class="history-duration">00h00p07s</span> <span class="history-code">Cổng 1</span>
                                            </div> 
                                            <div class="history-row">
                                                <span class="history-time">06/04/2020 15:02 CH</span> <span class="history-duration">00h00p07s</span> <span class="history-code">Cổng 1</span>
                                            </div> 
                                            <div class="history-row">
                                                <span class="history-time">06/04/2020 15:02 CH</span> <span class="history-duration">00h00p07s</span> <span class="history-code">Cổng 1</span>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="pad">
                                        <h3>Lịch sử: </h3>
                                        <div class="clear-fix" style="padding-left: 30px;">
                                            Chưa có lịch
                                        </div>
                                      </div>
                                      <div class="pad" >
                                        <h3 style="padding-left: 10px;">Hướng dẫn sử dụng: <span><a href="#" style="display: inline;"> Nhấn vào đây</a></span></h3> 
                                      </div>
                                    </div>
                                    {{-- Đặt lịch --}}
                                    <div class="tab-pane pad" id="schedule-device" role="tabpanel">
                                      <div class="schedule-list">
                                        <div class="pad-schedule">
                                          <div class="row bg-default">
                                              <div class="col-lg-12 col-md-12 col-12 text-right">
                                                  <button class="btn btn-success btn-set-schedule" style="margin:0 0 10px 0;"><i class="fas fa-plus pr-2"></i>Đặt lịch</button>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-lg-3 col-md-3 col-12">
                                                <div class="schedule-name">
                                                  <h3 class="text-left">Bật đèn</h3>
                                                  <span>14:00</span> <span>(1 phút)</span>
                                                </div>
                                              </div>
                                              <div class="col-lg-3 col-md-3 col-12">
                                                <div class="schedule-detail">
                                                    <p>Ngày 6 Tháng 4 Năm 2020</p>
                                                    <p>Cổng 1 2 3</p>
                                                </div>
                                              </div>
                                              <div class="col-lg-3 col-md-3 col-12">
                                                <div class="shedule-action">
                                                    <button class="btn btn-outline-warning" style="margin: 0 10px;"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-outline-danger" style="margin: 0 10px;"><i class="fas fa-trash"></i></button>
                                                </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="schedule-active">
                                                    <input type="checkbox" class="schedule-active-button" data-toggle="toggle" data-on="ON" data-off="OFF">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="pad-schedule">
                                          <div class="row">
                                              <div class="col-lg-3 col-md-3 col-12">
                                                <div class="schedule-name">
                                                  <h3 class="text-left">Bật đèn Phòng ngủ</h3>
                                                  <span>14:00</span> <span>(1 phút)</span>
                                                </div>
                                              </div>
                                              <div class="col-lg-3 col-md-3 col-12">
                                                <div class="schedule-detail">
                                                    <p>Ngày 6 Tháng 4 Năm 2020</p>
                                                    <p>Cổng 1 2 3</p>
                                                </div>
                                              </div>
                                              <div class="col-lg-3 col-md-3 col-12">
                                                <div class="shedule-action">
                                                    <button class="btn btn-outline-warning" style="margin: 0 10px;"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-outline-danger" style="margin: 0 10px;"><i class="fas fa-trash"></i></button>
                                                </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="schedule-active">
                                                    <input type="checkbox" class="schedule-active-button" data-toggle="toggle" data-on="ON" data-off="OFF">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      </div>
                                      {{-- Tạo lịch mới --}}
                                        <div class="row d-none" id="add-schedule-device-content">
                                          <div class="col-md-12 col-12">
                                            <form class="form" method="POST" action="#" enctype="multipart/form-data">
                                            @csrf
                                              <div class="box-body">
                                                  <h4 class="box-title text-info"><i class="ti-user mr-15"></i> Tạo lịch mới</h4>
                                                  <hr class="my-15">
                                                  <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                                                      <div class="form-group">
                                                        <label>Tên lịch</label>
                                                        <input id="schedule_name" type="text" class="form-control" name="schedule_name" value="" placeholder="Tên lịch" autofocus>
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                                                      <div class="form-group">
                                                        <label>Thời gian hoạt động</label>
                                                        <input id="detail" type="text" class="form-control" name="detail" value="" required placeholder="0" autofocus>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                                                        <div class="row">
                                                          <div class="col-lg-5 col-md-5 col-xs-12 col-12 getTime">
                                                              <div class="form-group">
                                                                  <label>Chọn giờ:</label>
                                                                  <div class='input-group date' id='getTime'>
                                                                      <input type='text' class="form-control" />
                                                                      <span class="input-group-addon">
                                                                          <span class="glyphicon glyphicon-time"></span>
                                                                      </span>
                                                                  </div>
                                                              </div>
                                                           </div>
                                                           <div class="col-lg-7 col-md-7 col-xs-12 col-12 getDate">
                                                              <div class="form-group">
                                                                  <label>Chọn ngày:</label>
                                                                  <div class='input-group date' id='getDate'>
                                                                      <input type='text' class="form-control" />
                                                                      <span class="input-group-addon">
                                                                          <span class="glyphicon glyphicon-calendar"></span>
                                                                      </span>
                                                                  </div>
                                                              </div>
                                                           </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                                                      <div class="row">
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                      <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                                                        <div class="demo-radio-button d-flex flex-row">
                                                          <input name="repeat-schedule" type="radio" class="select-type-schedule" value="0" id="no-repeat" class="with-gap radio-col-grey" checked="">
                                                          <label for="no-repeat">Không lặp</label>
                                                          <input name="repeat-schedule" type="radio" class="select-type-schedule" value="1" id="weekly" class="with-gap radio-col-red" >
                                                          <label for="weekly">Hàng tuần</label>         
                                                          <input name="repeat-schedule" type="radio" class="select-type-schedule" value="2" id="monthly" class="with-gap radio-col-yellow">
                                                          <label for="monthly">Hàng tháng</label>
                                                          <input name="repeat-schedule" type="radio" class="select-type-schedule" value="3" id="years" class="with-gap radio-col-deep-orange">
                                                          <label for="years">Hàng năm</label>         
                                                        </div>
                                                      </div>
                                                  </div>
                                                  <div class="row d-none daily-schedule">
                                                    <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                                                      <label for="mon" class="btn btn-orange">Mon<input type="checkbox" id="mon" class="badgebox"><span class="badge">&check;</span></label>
                                                      <label for="tue" class="btn btn-primary">Tue<input type="checkbox" id="tue" class="badgebox"><span class="badge">&check;</span></label>
                                                      <label for="wed" class="btn btn-info">Wed<input type="checkbox" id="wed" class="badgebox"><span class="badge">&check;</span></label>
                                                      <label for="thur" class="btn btn-success">Thur<input type="checkbox" id="thur" class="badgebox"><span class="badge">&check;</span></label>
                                                      <label for="fri" class="btn btn-warning">Fri<input type="checkbox" id="fri" class="badgebox"><span class="badge">&check;</span></label>
                                                      <label for="sat" class="btn btn-danger">Sat<input type="checkbox" id="sat" class="badgebox"><span class="badge">&check;</span></label>
                                                      <label for="sun" class="btn btn-pink">Sun<input type="checkbox" id="sun" class="badgebox"><span class="badge">&check;</span></label>
                                                    </div>
                                                  </div>
                                              </div>
                                              <!-- /.box-body -->
                                              <div class="box-footer">
                                                  <a class="btn btn-warning btn-set-schedule-cancel mr-1" type="button">
                                                    <i class="ti-trash"></i> Cancel
                                                  </a>
                                                  <button type="submit" class="btn btn-primary">
                                                    <i class="ti-save-alt"></i> Save
                                                  </button>
                                              </div>  
                                            </form>
                                          </div>
                                        </div>
                                      {{-- ./Tạo lịch mới --}}
                                    </div>
                                    {{-- ./Đặt lịch --}}

                                    {{-- Setting device --}}
                                    <div class="tab-pane pad" id="setting-device" role="tabpanel">
                                      <div class="btn-setting-device d-flex flex-row justify-content-around mt-5" >
                                        <div class="btn-info-setting" >
                                            <a href="#" type="button" class="btn btn-outline btn-success mb-5" >Thông tin chung</a>
                                        </div>
                                        <div class="btn-setting">
                                            <a href="#" type="button" class="btn btn-outline btn-danger mb-5">Cài đặt khác</a>
                                        </div>
                                      </div>
                                      <div class="row d-none" id="info-device-content">
                                          <div class="col-md-12">
                                            <form class="form" id="edit-info-device-form" method="POST" action="" enctype="multipart/form-data">
                                            @csrf
                                              <div class="box-body">
                                                  <div class="align-middle d-flex justify-content-between">
                                                    <h4 class="box-title text-info"><i class="fas fa-info-circle mr-15"></i>Thông tin chung:</h4>
                                                    <a  class="btn btn-warning btn-sm align-self-center btn-info-back"><i class="fa fa-undo pr-1"></i>Quay lại</a>
                                                  </div>
                                                  <hr class="my-15">
                                                  <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label>Tên thiết bị:</label>
                                                        <input id="nickname_device" type="text" class="form-control" name="nickname_device" value="" placeholder="Tên thiết bị" autofocus>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Phòng:</label>
                                                            <select class="form-control edit-device-location-type" id="edit-device-location-type" name="location_id">
                                                             
                                                            </select>
                                                        </div>
                                                    </div>
                                                   
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label>Địa chỉ IP:</label>
                                                        <input id="ip-address" type="text" class="form-control" name="ip-address" value="" disabled="true">
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label>Mật khẩu:</label>
                                                        <input id="password-device" type="text" class="form-control" name="password-device" value="" disabled="true">
                                                      </div>
                                                    </div>
                                                  </div>
                                              </div>
                                              <!-- /.box-body -->
                                              <div class="box-footer">
                                                  <button type="submit" class="btn btn-primary">
                                                    <i class="ti-save-alt"></i> Lưu lại
                                                  </button>
                                              </div>  
                                            </form>
                                          </div>
                                      </div>
                                      <div class="row d-none" id="setting-device-content">
                                          <div class="col-md-12">
                                              <div class="box-body">
                                                  <div class="align-middle d-flex justify-content-between">
                                                    <h4 class="box-title text-info"><i class="fas fa-info-circle mr-15"></i>Cài đặt:</h4>
                                                    <a  class="btn btn-warning btn-sm align-self-center btn-back-setting-device"><i class="fa fa-undo pr-1"></i>Quay lại</a>
                                                  </div>
                                                  <hr class="my-15">
                                                  {{-- Max-time --}}
                                                  <form class="form" id="max-time-device" method="POST" action="#" enctype="multipart/form-data">
                                                      @csrf
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                                                          <div class="box box-outline-primary">
                                                            <div class="box-header with-border">
                                                              <h4 class="box-title"><strong>Thời gian hoạt đông tối đa:</strong></h4>
                                                            </div>
                                                            <div class="box-body">
                                                               <div class="row">
                                                                  <div class="col-lg-9 col-md-9 col-xs-12 col-12">
                                                                      <div class="d-flex flex-row justify-content-between">
                                                                          <div class="form-group">
                                                                            <label class="control-label">Ngày:</label>
                                                                            <input type="number" class="form-control" name="max-date" min="0" max="30" />
                                                                          </div>
                                                                          <div class="form-group">
                                                                            <label class="control-label">Giờ:</label>
                                                                            <input type="number" class="form-control" name="max-date" min="0" max="23" />
                                                                          </div>
                                                                          <div class="form-group">
                                                                            <label class="control-label">Phút:</label>
                                                                            <input type="number" class="form-control" name="max-date" min="0" max="59" />
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-lg-3 col-md-3 col-xs-12 col-12 d-flex flex-row align-items-center">
                                                                      <button type="submit" class="btn btn-primary btn-max-time">
                                                                        <i class="ti-save-alt"></i> Lưu lại
                                                                      </button>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                  </form>
                                                  {{-- ./Max-time --}}
                                                  {{-- camera-setting --}}
                                                  <form class="form" id="camera-settings" method="POST" action="#" enctype="multipart/form-data">
                                                      @csrf
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                                                          <div class="box box-outline-primary">
                                                            <div class="box-header with-border">
                                                              <h4 class="box-title"><strong>Cài đặt camera:</strong></h4>
                                                            </div>
                                                            <div class="box-body">
                                                               <div class="row">
                                                                  <div class="col-lg-9 col-md-9 col-xs-12 col-12">
                                                                      Chưa hỗ trợ
                                                                  </div>
                                                                  <div class="col-lg-3 col-md-3 col-xs-12 col-12 d-flex flex-row align-items-center">
                                                                      <button type="submit" class="btn btn-primary btn-camera-setting">
                                                                        <i class="ti-save-alt"></i> Lưu lại
                                                                      </button>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                  </form>
                                                  {{-- ./camera-setting --}}
                                                  {{-- send-command-control --}}
                                                  <form class="form" id="command-control" method="POST" action="#" enctype="multipart/form-data">
                                                      @csrf
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                                                          <div class="box box-outline-primary">
                                                            <div class="box-header with-border">
                                                              <h4 class="box-title"><strong>Gửi lệnh điều khiển:</strong></h4>
                                                            </div>
                                                            <div class="box-body">
                                                               <div class="row">
                                                                  <div class="col-lg-9 col-md-9 col-xs-12 col-12">
                                                                      <input type="number" name="command-control" class="form-control">
                                                                  </div>
                                                                  <div class="col-lg-3 col-md-3 col-xs-12 col-12 d-flex flex-row align-items-center">
                                                                      <button type="submit" class="btn btn-primary btn-command-control">
                                                                        <i class="ti-save-alt"></i> Gửi lệnh
                                                                      </button>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                  </form>
                                                  {{-- ./send-command-control --}}
                                                  {{-- send-command-control --}}
                                                  <form class="form" id="power-source" method="POST" action="#" enctype="multipart/form-data">
                                                      @csrf
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                                                          <div class="box box-outline-primary">
                                                            <div class="box-header with-border">
                                                              <h4 class="box-title"><strong>Cài đặt công suất phát:</strong></h4>
                                                            </div>
                                                            <div class="box-body">
                                                               <div class="row">
                                                                  <div class="col-lg-9 col-md-9 col-xs-12 col-12">
                                                                      <div class="form-group">
                                                                          <label>Chọn công suất (dBm):</label>
                                                                          <select class="form-control">
                                                                            <option>10</option>
                                                                            <option>11</option>
                                                                            <option>12</option>
                                                                          </select>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-lg-3 col-md-3 col-xs-12 col-12 d-flex flex-row align-items-center">
                                                                      <button type="submit" class="btn btn-primary btn-power-source">
                                                                        <i class="ti-save-alt"></i> Lưu lại
                                                                      </button>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                  </form>
                                                  {{-- ./send-command-control --}}
                                              </div>
                                              <!-- /.box-body -->
                                          </div>
                                      </div>
                                    </div>
                                    {{-- ./Setting device --}}
                                    <div class="tab-pane pad" id="share-device" role="tabpanel">
                                        Chia sẻ thiết bị
                                    </div> 
                                    <div class="tab-pane pad" id="history-device" role="tabpanel">
                                        Lịch sử trạng thái
                                    </div>
                                    <div class="tab-pane pad" id="update-device" role="tabpanel">
                                        <div class="btn-update-delete-device d-flex flex-row justify-content-around mt-5">
                                          <div class="btn-update-status">
                                              <a href="#" type="button" class="btn btn-outline btn-success mb-5">Cập nhật trạng thái</a>
                                          </div>
                                          <div class="btn-delete-device">
                                              <a href="#" type="button" class="btn btn-outline btn-danger mb-5">Xóa thiết bị</a>
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                          
                      </div>
                  </div>

                  {{-- ./Control Device Screen --}}
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- Modal -->
<div class="modal modal-right fade" id="modal-right" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Điều khiển</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row modal-append">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<!-- Modal Device by Location -->
<div class="modal modal-right fade" id="modal-right-device-location" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Điều khiển</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row modal-right-device-location-append">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<input type="hidden" class="enroll-location" value="{{$Enroll_location}}" data-id="{{$local['id']}}">
@endsection

