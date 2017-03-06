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
            <img class="img-header-news-page" src="{{ URL::asset('images/icon-cuu-ho-toan-quoc.png')}}"/>
            <img class="line-header" src="{{ URL::asset('images/line-news-page.png')}}"/>
        </div>
        <div class="list-news-page" id="style-4">
            <form class="form-filter-support-car">
                <select class="select-city" name="filter_city" id="filter-city-support">
                    <option value="all">ALL - Chọn theo tỉnh thành</option>
                    @foreach($listCity as $city)
                        <option value="{{str_slug($city->city_name, '-')}}" @if($citySelected == (str_slug($city->city_name, '-'))) selected @endif>{{$city->city_name}}</option>
                    @endforeach
                </select>
            </form>
            <div class="inner-list-news-page" >
                @foreach($listSupportCar as $supportCar)
                    <div class="item-support-page">
                        <img src="{{ URL::asset($supportCar->thumb)}}"/>
                        <div class="cover-info-support">
                            <h4>{{$supportCar->title}}</h4>
                            <p>{{$supportCar->address}}</p>
                            <p class="p-phone">{{$supportCar->phone}}</p>
                        </div>
                    </div>
                @endforeach
                <div class="paging-div">
                    {{ $listSupportCar->links() }}
                </div>
            </div>
        </div>
    </div>
@stop