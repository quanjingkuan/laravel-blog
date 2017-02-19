<aside class="right">
@section('style')
  .rnav ul li {float:left}
@stop
@if($submenu)
        <div class="rnav">
            <ul>
      @foreach($submenu as $b=>$a)
              <li class="rnav{{ $b+1 }}" style="color:#fff">
                <a href="{{ url('cate').'/'.$a->cate_id }}">{{ $a->cate_name }}</a>
              </li>
      @endforeach
            </ul>
        </div>
@endif
    <h3>
      <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
      @foreach($new as $n)
      <li><a href="{{ url('/a/'.$n->art_id) }}" title="{{ $n->art_name }}" target="_blank">{{ $n->art_title  }}</a></li>
      @endforeach
    </ul>
    <h3 class="ph">
      <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
     @foreach($hots as $h)
      <li><a href="{{ url('/a/'.$h->art_id) }}" title="{{ $h->art_name }}" target="_blank">{{ $h->art_title  }}</a></li>
      @endforeach
    </ul>
    <h3 class="links">
      <p>友情<span>链接</span></p>
    </h3>
    <ul class="website">
    @foreach($link as $l)
      <li><a href="{{ $l->links_url }}">{{ $l->links_name }}</a></li>
    @endforeach
    </ul> 
    </div>  
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
    <!-- Baidu Button END -->   
    </aside>