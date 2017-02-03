@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-news">
            <img class="img-header-news-page" src="{{ URL::asset('images/icon-news-page.png')}}"/>
            <img src="{{ URL::asset('images/line-news-page.png')}}"/>
        </div>
        <div class="list-news-page" id="style-4">
            <div class="inner-list-news-page" >
                @foreach($listNews as $news)
                <div class="item-news-page">
                    <a href="{{ URL::to('tin-tuc/'.$news->id.'/abc') }}"><img class="img-thumb-item-news" src="{{ URL::asset($news->thumbnail)}}"/></a>
                    <div class="cover-info-item-news">
                        <a href="{{ URL::to('tin-tuc/'.$news->id.'/abc') }}" class="title-item-news"><img src="{{ URL::asset('images/icon-title-news.png')}}"/> {{$news->title}}</a>
                        <p class="p-post-by">Đăng bởi <span>{{$news->username}}</span> - 01/07/2017</p>
                        <p class="summary-news-page">{{$news->summary}}...</p>
                        <a class="bt-chi-tiet-news" href="{{ URL::to('tin-tuc/'.$news->id.'/abc') }}">Chi tiết <small> >> </small></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@stop