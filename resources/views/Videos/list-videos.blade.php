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

</style>
@section('content')
    <div class="video-page">
        <div class="header-video">
            <img class="img-header-news-page" src="{{ URL::asset('images/bg-videos-header.png')}}"/>
            {{--<img class="line-header" src="{{ URL::asset('images/line-news-page.png')}}"/>--}}
        </div>
        <div class="list-video-page" id="style-4">
            <form class="form-filter-video" action="" method="post">
                <select class="select-cat" name="filter_cat" id="filter-cat">
                    <option value="" >ALL - Chọn theo chủ đề</option>
                    @foreach($listCats as $cat)
                        <option value="{{$cat['id'].'-'.str_slug($cat['catName'])}}" @if($catSelected == $cat['id']) selected @endif>{{$cat['catName']}}</option>
                    @endforeach
                </select>
            </form>
            <div class="inner-list-news-page" >
                @foreach($listVideos as $v)
                <div class="item-video-page">
                    <div class="cover-info-item-video">
                        <label>{{$v->title}}</label>
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
    <script type="application/javascript">
        $("#filter-cat").change(function()
        {
            var vl = $("#filter-cat").val();
            if(vl!="all" && vl!="" && vl !="undefined" && vl != undefined){
                window.location = "/videos-xe-oto/"+vl;
            }else{
                window.location = "/videos-xe-oto/";
            }

        });


    </script>
@stop