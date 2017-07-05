@extends('Layouts.frontend')
@section('headScript')
    <style>
        .container-fluid{
            background: none !important;
        }
        .img-header-news-page {
            width: 350px;
        }
        @media (max-width: 980px){
            .img-header-news-page {
                width: 65% !important;
            }
        }

    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{!! asset("/css/font-awesome.css")!!}">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG_m7pyGlSJYAQppYJhF4JqcC2DAQZRSk&language=vi&libraries=places" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script type="text/javascript">
        var iconMarker = "{!! asset('img/a.png') !!}";
    </script>
    <script type="text/javascript" src="{!! asset('js/gmaps.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/main.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/jquery-ui.min.js') !!}"></script>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/jquery-ui.min.css') !!}" />
    <link rel="stylesheet" type="text/css" href="{!! asset('css/style.css') !!}" />
    <link rel="stylesheet" type="text/css" href="{!! asset('css/font-awesome/css/font-awesome.min.css') !!}" />
@endsection
@section('content')
    <div class="news-page">
        <div class="header-news">
            <img class="img-header-news-page" src="{{ URL::asset('images/icon-bai-giu-xe.png')}}"/>
            <img class="line-header" src="{{ URL::asset('images/line-news-page.png')}}"/>
        </div>
        <div class="list-news-page" id="style-4">

            <div class="inner-list-news-page" >
                <div class="map-container">
                    <div class="col-xs-12 map-search">
                        <label class="hidden-xs">Tìm Kiếm: </label>
                        <div class="clearfix"></div>
                        <input type="search" class="map-in col-xs-10 form-control" name='search' id='searchInput' placeholder="Tìm kiếm" />
                        <button type="button" class="btn map-search-btn col-xs-2"" data-toggle="modal" data-target="#configModal">Nâng Cao</button>
                    </div>
                    <div class="col-xs-12 map-button">
                        <div class="col-xs-6">
                            <button class="btn map-btn" id="direction">Dẫn Đường</button>
                        </div>
                        <div class="col-xs-6">
                            <button class="btn map-btn" id="findNearLocation">Vị Trí Gần Nhất</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 " style="padding: 15px;">
                        <div id="map" class="map-content"></div>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="inner-list-news-page">
                    <?php foreach($data as $dataVal) { ?>
                    <div class="item-support-page">
                        <a>
                            <img src="{{ url($dataVal->thumb) }}" />
                        </a>
                        <div class="cover-info-support">
                            <a><h4>{!! $dataVal->title !!}</h4></a>
                            <p> {!! $dataVal->address !!}</p>
                            <p class="p-phone">{!! $dataVal->phone !!}</p>
                        </div>
                    </div>
                    <?php } ?>
                    {!! $data->render() !!}
                </div>
                <div class="clearfix"></div>
                <!-- Modal -->
                <div id="configModal" class="modal fade" role="dialog">
                    <div class="modal-dialog" style="width: auto!important">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Tìm Kiếm Nâng Cao</h4>
                            </div>
                            <div class="modal-body">
                                <p>
                                    <label for="amount">Phạm Vi:</label>
                                    <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                </p>
                                <div id="slider"></div>
                                <div class="clearfix"></div>
                                <p>
                                    <label>Thành Phố:</label>
                                    <select class="form-control" id="city" style="width: 100%">
                                        <option value="0">--Thành Phố--</option>
                                        <option  >Hà Nội</option>
                                        <option  >Hải Phòng</option>
                                        <option  >Bắc Giang</option>
                                        <option  >Bắc Kạn</option>
                                        <option  >Bắc Ninh</option>
                                        <option  >Cao Bằng</option>
                                        <option  >Điện Biên</option>
                                        <option  >Hòa Bình</option>
                                        <option  >Hải Dương</option>
                                        <option  >Hà Giang</option>
                                        <option  >Hà Nam</option>
                                        <option  >Hưng Yên</option>
                                        <option  >Lào Cai</option>
                                        <option  >Lai Châu</option>
                                        <option  >Lạng Sơn</option>
                                        <option  >Ninh Bình</option>
                                        <option  >Nam Định</option>
                                        <option  >Phú Thọ</option>
                                        <option  >Quảng Ninh</option>
                                        <option  >Sơn La</option>
                                        <option  >Thái Bình</option>
                                        <option  >Thái Nguyên</option>
                                        <option  >Tuyên Quang</option>
                                        <option  >Vĩnh Phúc</option>
                                        <option  >Yên Bái</option>
                                        <option  >Đà Nẵng</option>
                                        <option  >Thừa Thiên Huế</option>
                                        <option  >Khánh Hòa</option>
                                        <option  >Lâm Đồng</option>
                                        <option  >Bình Định</option>
                                        <option  >Bình Thuận</option>
                                        <option  >Đắk Lắk</option>
                                        <option  >Đắk Nông</option>
                                        <option  >Gia Lai</option>
                                        <option  >Hà Tĩnh</option>
                                        <option  >Kon Tum</option>
                                        <option  >Nghệ An</option>
                                        <option  >Ninh Thuận</option>
                                        <option  >Phú Yên</option>
                                        <option  >Quảng Bình</option>
                                        <option  >Quảng Nam</option>
                                        <option  >Quảng Ngãi</option>
                                        <option  >Quảng Trị</option>
                                        <option  >Thanh Hóa</option>
                                        <option  >TP.HCM</option>
                                        <option  >Bình Dương</option>
                                        <option  >Bà Rịa Vũng Tàu</option>
                                        <option  >Cần Thơ</option>
                                        <option  >An Giang</option>
                                        <option  >Bạc Liêu</option>
                                        <option  >Bình Phước</option>
                                        <option  >Bến Tre</option>
                                        <option  >Cà Mau</option>
                                        <option  >Đồng Tháp</option>
                                        <option  >Đồng Nai</option>
                                        <option  >Hậu Giang</option>
                                        <option  >Kiên Giang</option>
                                        <option  >Long An</option>
                                        <option  >Sóc Trăng</option>
                                        <option  >Tiền Giang</option>
                                        <option  >Tây Ninh</option>
                                        <option  >Trà Vinh</option>
                                        <option  >Vĩnh Long</option>
                                    </select>
                                </p>
                                <div class="clearfix"></div>
                                <p>
                                    <label>Quận Huyên:</label>
                                    <select class="form-control" id="district" style="width: 100%">
                                        <option value="0">--Quận Huyện--</option>
                                    </select>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" id="change" data-dismiss="modal">Ok</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Trở Lại</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop