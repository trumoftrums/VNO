@extends('Layouts.frontend')
<style>
    .container-fluid{
        background: none !important;
    }
    .news-page .list-news-page{
        height:555px !important;
    }
</style>
@section('content')
    <div class="news-page">
        <div class="header-detail-news">
            <h3><img class="arrow-before-title" src="{{ URL::asset('images/icon-title-news.png')}}"/> {{$detailNews->title}}</h3>
            <p>Đăng bởi <span>{{$detailNews->username}}</span> - {{date_format(date_create($detailNews->created_date), 'H:i a - d/m/Y')}}</p>
        </div>
        <div class="list-news-page" id="style-4">
            <div class="detail-news" >
                <img class="thumb-item-news" src="{{ URL::asset($detailNews->image)}}"/>
                {{--{{$detailNews->description}}--}}
                <?php echo $detailNews->description; ?>
            </div>
            <div class="related-news">
                <h3><img class="arrow-before-title" src="{{ URL::asset('images/icon-title-news.png')}}"/> TIN TỨC KHÁC</h3>
                <ul>
                    @foreach($relatedNews as $val)
                    <li>
                        <a class="bt-detail" href="{{ URL::to('tin-tuc/'.$val->id.'/'.str_slug($val->title, '-')) }}"><img src="{{ URL::asset($val->thumbnail)}}"/></a>
                        <div class="cover-related-item-news">
                            <a class="title" href="{{ URL::to('tin-tuc/'.$val->id.'/'.str_slug($val->title, '-')) }}">{{$val->title}}</a>
                            <p>{{date_format(date_create($val->created_date), 'd/m/Y H:i a')}}</p>
                            <a class="bt-detail" href="{{ URL::to('tin-tuc/'.$val->id.'/'.str_slug($val->title, '-')) }}">Chi tiết <small> >> </small></a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop
