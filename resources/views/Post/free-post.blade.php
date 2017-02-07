@extends('Layouts.frontend')

@section('content')
    <div class="detail-post">
        <div class="header-free-post">
            <img class="avatar-free-post img-circle" src="{{ URL::asset('images/nghiem_bao_pic.png')}}"/>
            <h4 class="user-name-free-post">
                <img class="line-free-post" src="{{ URL::asset('images/line.png')}}"/>
                Thang nguyen
                <img class="line-free-post" src="{{ URL::asset('images/line.png')}}"/>
            </h4>
        </div>
        <div class="info-post">
            <ul class="ul-cover-tabs-post">
                <li class="active"><a data-toggle="tab" href="#tab1">THÔNG TIN CĂN BẢN</a></li>
                <li><a data-toggle="tab" href="#tab2">THÔNG TIN AN TOÀN</a></li>
                <li><a data-toggle="tab" href="#tab3">TÍNH TIỆN NGHI</a></li>
                <li><a data-toggle="tab" href="#tab4">THÔNG TIN KỸ THUẬT</a></li>
            </ul>
            <div class="cover-tab-post tab-content">
                <div id="tab1" class="tab-pane fade in active">

                </div>
                <div id="tab2" class="tab-pane fade">

                </div>
                <div id="tab4" class="tab-pane fade">

                </div>
            </div>
        </div>
    </div>
@stop
