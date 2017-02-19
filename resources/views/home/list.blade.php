@extends('home._layouts.app')
@section('title')
{{ $field->cate_name }} - {{ Config::get('web.web_title') }}
@endsection
@section('meta')
<meta name=”description” content={{ $field->cate_keywoed }}> 
<meta name=”keyword” content=”{{ $field->cate_desction }}“> 
@endsection
@section('style')
<link href="{{ asset('css/base.css') }}" rel="stylesheet">
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection
@include('home._layouts._header')
@section('content')
<article class="blogs">
<h1 class="t_nav"><a href="/" class="n1">网站首页</a><a href="{{ url('cate/') }}/{{ $field->cate_id }}" class="n2">{{ $field->cate_name }}</a></h1>
<div class="newblog left">
@foreach($art as $a)
   <h2>{{ $a->art_title }}</h2>
   <p class="dateview"><span>{{ date('Y-m-d',$a->art_time) }}</span><span>作者：{{ $a->art_editor }}</span><span>分类：[<a href="{{url('cate/').'/'.$field->cate_id}}">{{ $field->cate_name }}</a>]</span></p>
    <figure><img src="{{ $a->art_thumb }}"></figure>
    <ul class="nlist">
      <p>{{ $a->art_info }}...</p>
      <a title="/" href="{{url('a/').'/'.$a->art_id}}" target="_blank" class="readmore">阅读全文>></a>
    </ul>

    <div class="line"></div>
@endforeach
    <div class="blank"></div>
    <div class="ad">  
    <img src="{{ asset('images/ad.png')}}">
    </div>
</div>
  @include('home._layouts._rights')

</article>
@include('home._layouts._footer')
@stop