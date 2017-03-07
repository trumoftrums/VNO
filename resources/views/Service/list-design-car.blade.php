@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
    .img-header-news-page {
        width: 500px !important;
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-news">
            <img class="img-header-news-page" src="{{ URL::asset('images/icon-dia-chi-do-xe.png')}}"/>
            <img class="line-header" src="{{ URL::asset('images/line-news-page.png')}}"/>
        </div>
        <div class="list-news-page" id="style-4">
            <form class="form-filter-support-car">
                <select class="select-city" name="filter_city" id="filter-city-design">
                    <option value="all">ALL - Chọn theo tỉnh thành</option>
                    @foreach($listCity as $city)
                        <option value="{{str_slug($city->city_name, '-')}}" @if($citySelected == (str_slug($city->city_name, '-'))) selected @endif>{{$city->city_name}}</option>
                    @endforeach
                </select>
            </form>
            <div class="inner-list-news-page" >
                @if(count($listDesignCar)>0)
                @foreach($listDesignCar as $designCar)
                    <div class="item-support-page">
                        <a href="{{ URL::to('do-xe-uy-tin/'.$designCar->id.'/'.str_slug($designCar->title, '-')) }}"><img src="{{ URL::asset($designCar->thumb)}}"/></a>
                        <div class="cover-info-support">
                            <a href="{{ URL::to('do-xe-uy-tin/'.$designCar->id.'/'.str_slug($designCar->title, '-')) }}"><h4>{{$designCar->title}}</h4></a>
                            <p>{{$designCar->address}}</p>
                            <p class="p-phone">{{$designCar->phone}}</p>
                        </div>
                    </div>
                @endforeach
                    @else
                        <p style="text-align: center;">Thông tin đang được cập nhật. Vui lòng quay lại sau.</p>
                    @endif
                <div class="paging-div">
                    {{ $listDesignCar->links() }}
                </div>
            </div>
        </div>
    </div>
@stop