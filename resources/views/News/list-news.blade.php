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
                    <a href="{{ URL::to('tin-tuc/'.$news->id.'/'.str_slug($news->title, '-')) }}"><img class="img-thumb-item-news" src="{{ URL::asset($news->thumbnail)}}"/></a>
                    <div class="cover-info-item-news">
                        <a href="{{ URL::to('tin-tuc/'.$news->id.'/'.str_slug($news->title, '-')) }}" class="title-item-news"><img class="arrow-before-title" src="{{ URL::asset('images/icon-title-news.png')}}"/> {{$news->title}}</a>
                        <p class="p-post-by">Đăng bởi <span>{{$news->username}}</span> - {{date_format(date_create($news->created_date), 'd/m/Y H:i a')}}</p>
                        <p class="summary-news-page">{{$news->summary}}...</p>
                        <a class="bt-chi-tiet-news" href="{{ URL::to('tin-tuc/'.$news->id.'/'.str_slug($news->title, '-')) }}">Chi tiết <small> >> </small></a>
                    </div>
                </div>
                @endforeach
                <div class="paging-div">
                    {{ $listNews->links() }}
                </div>
            </div>
        </div>
    </div>
@stop