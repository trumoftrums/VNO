@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
    .img-header-news-page {
        width: 350px !important;
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-news">
            <img class="img-header-news-page" src="{{ URL::asset('images/icon-bai-giu-xe.png')}}"/>
            <img class="line-header" src="{{ URL::asset('images/line-news-page.png')}}"/>
        </div>
        <div class="list-news-page" id="style-4">
            <form class="form-filter-support-car">
                <select class="select-city" name="filter_city" id="filter-city-bai-xe">
                    <option value="all">ALL - Chọn theo tỉnh thành</option>
                    @foreach($listCity as $city)
                        <option value="{{str_slug($city->city_name, '-')}}" @if($citySelected == (str_slug($city->city_name, '-'))) selected @endif>{{$city->city_name}}</option>
                    @endforeach
                </select>
            </form>
            <div class="inner-list-news-page" >
                @foreach($listBaiGiuXe as $baixe)
                    <div class="item-support-page">
                        <img src="{{ URL::asset($baixe->thumb)}}"/>
                        <div class="cover-info-support">
                            <h4>{{$baixe->title}}</h4>
                            <p>{{$baixe->address}}</p>
                            <p class="p-phone">{{$baixe->phone}}</p>
                        </div>
                    </div>
                @endforeach
                <div class="paging-div">
                    {{ $listBaiGiuXe->links() }}
                </div>
            </div>
        </div>
    </div>
@stop