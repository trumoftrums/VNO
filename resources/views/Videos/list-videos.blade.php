@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
    @media (max-width: 980px){
        .img-header-news-page {
            width: 60% !important;
        }
    }
    iframe {
        max-height: 315px !important;
    }
    .item-video-page{
        width: 50%;
        float: left;
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-news">
            <img class="img-header-news-page" src="{{ URL::asset('images/icon-news-page.png')}}"/>
            <img class="line-header" src="{{ URL::asset('images/line-news-page.png')}}"/>
        </div>
        <div class="list-news-page" id="style-4">
            <div class="inner-list-news-page" >
                @foreach($listVideos as $v)
                <div class="item-video-page">
                    <div class="cover-info-item-news">
                        <a href="{{ URL::to('tin-tuc/'.$v->id.'/'.str_slug($v->title, '-')) }}" class="title-item-news"><img class="arrow-before-title" src="{{ URL::asset('images/icon-title-news.png')}}"/> {{$v->title}}</a>
                        <p class="p-post-by">Đăng bởi <span>{{$v->username}}</span> - {{date_format(date_create($v->created_at), 'd/m/Y H:i a')}}</p>

                    </div>
                    <?php
                        $embed = $v->embedCode;
                        $params = json_decode($v->embedParams,true);
                        foreach ($params as $k=>$p){
                            $embed = str_replace("[[$k]]","$p",$embed);
                        }
                        echo $embed."<br>";
                    ?>

                </div>
                @endforeach
                <div class="paging-div">
                    {{ $listVideos->links() }}
                </div>
            </div>
        </div>
    </div>
@stop