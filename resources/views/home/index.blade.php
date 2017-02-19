@extends('home._layouts.app')
@section('title')
{{ Config::get('web.web_title') }}
@endsection
@section('style')
<link href="{{ asset('css/base.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection
@include('home._layouts._header')
@section('content')
<article>
  <h2 class="title_tj">
    <p>文章<span>推荐</span></p>
  </h2>
  <div class="bloglist left">
  @foreach($data as $d)
    <h3>{{ $d->art_title }}</h3>
    <figure><img src="@if ($d->art_thumb != '')
          {{ $d->art_thumb }}
          @else
          images/1f8aea2172f6eb987c3de3f7ba474eb1.png
        @endif"></figure>
    <ul>
      <p>{{ $d->art_info }}...</p>
      <a title="{{ $d->art_title }}" href="{{ url('/a/'.$d->art_id) }}" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <p class="dateview">
    <span>{{ date('Y-m-d',$d->art_time) }}</span><span>作者：{{ $d->art_editor }}</span><span></span>
    </p>
    @endforeach
    {{ $data->links() }}
  </div>
  @include('home._layouts._rights')
</article>

@include('home._layouts._footer')
@stop

