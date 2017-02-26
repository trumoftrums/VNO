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
            <img class="img-header-news-page" src="{{ URL::asset('images/icon-vip-salon-page.png')}}"/>
            <img class="line-header" src="{{ URL::asset('images/line-news-page.png')}}"/>
        </div>
        <div class="list-news-page" id="style-4">
            <form class="form-filter-support-car">
                <select class="select-city" name="filter_city" id="filter-city-salon">
                    <option value="all">ALL - Chọn theo tỉnh thành</option>
                    <option value="ho-chi-minh" @if($city == 'ho-chi-minh') selected @endif>Hồ Chí Minh</option>
                    <option value="ha-noi" @if($city == 'ha-noi') selected @endif>Hà Nội</option>
                    <option value="da-nang" @if($city == 'da-nang') selected @endif>Đà Nẵng</option>
                </select>
            </form>
            <div class="inner-list-news-page" >
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
                <div class="paging-div">
                    {{ $listVipSalon->links() }}
                </div>
            </div>
        </div>
    </div>
@stop