@extends('home._layouts.app')
@section('title')
{{ $art->art_title }} - {{ Config::get('web.web_title') }}
@endsection
@section('meta')
<meta name=”description” content={{ $art->art_keyword }}> 
<meta name=”keyword” content=”{{ $art->cate_description }}“> 
@endsection
@section('style')
<link href="{{ asset('css/base.css') }}" rel="stylesheet">
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
<link href="{{ asset('css/new.css') }}" rel="stylesheet">
@endsection
@include('home._layouts._header')
@section('content')
<article class="blogs">
  <div class="index_about">
    <h2 class="c_titile">{{ $art->art_title }}</h2>
    <p class="box_c"><span class="d_time">发布时间：{{ date('Y-m-d',$art->art_time) }}</span><span>编辑：{{ $art->art_editor }}</span><span>查看次数：{{ $art->art_view }}</span></p>
    <ul class="infos">
      <p>{{ $art->art_info }}</p>
      <p>{!! $art->art_content !!}</p>
    </ul>
    <div class="keybq">
    <p><span>关键字词</span>：{{ $art->art_tags }}</p>
    
    </div>
    <div class="ad"> </div>
    <div class="nextinfo">
      <p>上一篇：
      @if($article['prev'])
      <a href="{{ url('a/').'/'.$article['prev']->art_id }}">
      {{ $article['prev']->art_title }}
      </a>
      @else
        没有了
      @endif
      </p>
      <p>下一篇：@if($article['next'])<a href="{{ url('a').'/'.$article['next']->art_id }}">{{ $article['next']->art_title }}</a>
      @else
        没有了
      @endif
      </p>
    </div>
{{--     <div class="otherlink">
      <h2>相关文章</h2>
      <ul>
        <li><a href="/news/s/2013-07-25/524.html" title="现在，我相信爱情！">现在，我相信爱情！</a></li>
        <li><a href="/newstalk/mood/2013-07-24/518.html" title="我希望我的爱情是这样的">我希望我的爱情是这样的</a></li>
        <li><a href="/newstalk/mood/2013-07-02/335.html" title="有种情谊，不是爱情，也算不得友情">有种情谊，不是爱情，也算不得友情</a></li>
        <li><a href="/newstalk/mood/2013-07-01/329.html" title="世上最美好的爱情">世上最美好的爱情</a></li>
        <li><a href="/news/read/2013-06-11/213.html" title="爱情没有永远，地老天荒也走不完">爱情没有永远，地老天荒也走不完</a></li>
        <li><a href="/news/s/2013-06-06/24.html" title="爱情的背叛者">爱情的背叛者</a></li>
      </ul>
    </div> --}}
  </div>
  @include('home._layouts._rights')
</article>
@include('home._layouts._footer')
@stop