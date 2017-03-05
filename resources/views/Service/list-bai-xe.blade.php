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
                    <option value="ho-chi-minh" @if($city == 'ho-chi-minh') selected @endif>Hồ Chí Minh</option>
                    <option value="ha-noi" @if($city == 'ha-noi') selected @endif>Hà Nội</option>
                    <option value="da-nang" @if($city == 'da-nang') selected @endif>Đà Nẵng</option>
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