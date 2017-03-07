@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
    .img-header-news-page {
        width: 380px !important;
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-news">
            <img class="img-header-news-page" src="{{ URL::asset('images/icon-showroom-toan-quoc.png')}}"/>
            <img class="line-header" src="{{ URL::asset('images/line-news-page.png')}}"/>
        </div>
        <div class="list-news-page" id="style-4">
            <form class="form-filter-support-car">
                <select class="select-city" name="filter_city" id="filter-city-salon">
                    <option value="all">ALL - Chọn theo tỉnh thành</option>
                    @foreach($listCity as $city)
                        <option value="{{str_slug($city->city_name, '-')}}" @if($citySelected == (str_slug($city->city_name, '-'))) selected @endif>{{$city->city_name}}</option>
                    @endforeach
                </select>
            </form>
            <div class="inner-list-news-page" >
                @if(count($listVipSalon)>0)
                @foreach($listVipSalon as $salon)
                    <div class="item-support-page">
                        <a href="{{ URL::to('vip-salon/'.$salon->id.'/'.str_slug($salon->title, '-')) }}"><img src="{{ URL::asset($salon->thumb)}}"/></a>
                        <div class="cover-info-support">
                            <a href="{{ URL::to('vip-salon/'.$salon->id.'/'.str_slug($salon->title, '-')) }}"><h4>{{$salon->title}}</h4></a>
                            <p>{{$salon->address}}</p>
                            <p class="p-phone">{{$salon->phone}}</p>
                        </div>
                    </div>
                @endforeach
                    @else
                        <p style="text-align: center;">Thông tin đang được cập nhật. Vui lòng quay lại sau.</p>
                    @endif
                <div class="paging-div">
                    {{ $listVipSalon->links() }}
                </div>
            </div>
        </div>
    </div>
@stop