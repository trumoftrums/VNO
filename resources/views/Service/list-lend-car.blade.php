@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
    .img-header-news-page {
        width: 500px;
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-news">
            <img class="img-header-news-page" src="{{ URL::asset('images/icon-cho-thue-xe.png')}}"/>
            <img class="line-header" src="{{ URL::asset('images/line-news-page.png')}}"/>
        </div>
        <div class="list-news-page" id="style-4">
            <form class="form-filter-support-car">
                <select class="select-city" name="filter_city" id="filter-city-lend">
                    <option value="all">ALL - Chọn theo tỉnh thành</option>
                    @foreach($listCity as $city)
                        <option value="{{str_slug($city->city_name, '-')}}" @if($citySelected == (str_slug($city->city_name, '-'))) selected @endif>{{$city->city_name}}</option>
                    @endforeach
                </select>
            </form>
            <div class="inner-list-news-page" >
                @if(count($listLendCar)>0)
                @foreach($listLendCar as $lendCar)
                    <div class="item-support-page">
                        <img src="{{ URL::asset($lendCar->thumb)}}"/>
                        <div class="cover-info-support">
                            <h4>{{$lendCar->title}}</h4>
                            <p>{{$lendCar->address}}</p>
                            <p class="p-phone">{{$lendCar->phone}}</p>
                        </div>
                    </div>
                @endforeach
                @else
                    <p style="text-align: center;">Thông tin đang được cập nhật. Vui lòng quay lại sau.</p>
                @endif
                <div class="paging-div">
                    {{ $listLendCar->links() }}
                </div>
            </div>
        </div>
    </div>
@stop