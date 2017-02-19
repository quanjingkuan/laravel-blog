<header>
  <div id="logo"><a href="/"></a></div>
  <nav class="topnav" id="topnav">
  @foreach ($tagn as $t)
      <a href="{{ url('cate/').'/'.$t->cate_id }}"><span>{{ $t->cate_name }}</span><span class="en">{{ $t->cate_view }}</span></a>
  @endforeach
    @foreach ($navs as $k=>$v)
      <a href="{{$v->nav_url}}"><span>{{ $v->nav_name }}</span><span class="en">{{ $v->nav_alias }}</span></a>
    @endforeach
  </nav>
</header>
<div class="banner">
  <section class="box">
    <ul class="texts">
      <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
      <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
      <p>加了锁的青春，不会再因谁而推开心门。</p>
    </ul>
    <div class="avatar"><a href="#"><span>后盾</span></a> </div>
  </section>
</div>
<div class="template">
  <div class="box">
    <h3>
      <p><span>站长</span>推荐 Recommend</p>
    </h3>
    <ul>
    @foreach($hot as $k=>$v)
      <li>
        <a href="{{ url('/a/'.$v->art_id) }}"  target="_blank"><img src="@if ($v->art_thumb != '')
          {{ $v->art_thumb }}
          @else
          images/1f8aea2172f6eb987c3de3f7ba474eb1.png
        @endif"></a>
        <span>{{ $v->art_title }}</span>
      </li>
    @endforeach
    </ul>
  </div>
</div>