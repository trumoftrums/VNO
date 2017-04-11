@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
    .news-page .list-news-page{
        height:555px !important;
    }
    .arrow-before-title {
        width: 50px !important;
        float: left;
        margin-top: -15px;
        margin-right: 5px;
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-detail-news">
            <h3><img class="arrow-before-title" src="{{ URL::asset('images/icon-title-design-car.png')}}"/>
                <a href="{{ URL::to('do-xe-uy-tin/all') }}">Địa Chỉ Sửa Xe/ Độ Xe Uy Tín </a>
                > {{$detailDesignCar->title}}</h3>
        </div>
        <div class="list-news-page" id="style-4">
            <div class="detail-news" >
                <img class="thumb-item-news" src="{{ URL::asset($detailDesignCar->images)}}"/>
                <?php echo $detailDesignCar->description ?>
            </div>
        </div>
    </div>
@stop
