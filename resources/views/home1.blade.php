@extends('layouts.master');
@section('title')
@lang('lang.location.title')
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @foreach ($locations as $local)
                <div class="col-lg-3 col-md-6 col-xs-6 col-6">
                    <div class="small-box bg-info location-home-box" >
                        <div class="inner">
                            <h3>{{ $local['count'] }}</h3>
                            <p>{{ $local['location_name'] }}</p>
                        </div>
                        <div class="icon">
                            <img src="{{ $local['type']['icon'] }}" alt="" width="50px" height="50px" srcset="">
                        </div>
                        <a class="small-box-footer modal-device-btn text-center" data-toggle="modal" data-id="{{ $local['id'] }}" data-target="#modal-right">Xem thiết bị <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endforeach
            
        </div>
        <!-- /.row -->			
    </div>  
</div>

<!-- Modal -->
<div class="modal modal-right fade" id="modal-right" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Devices</h5>
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


@endsection

