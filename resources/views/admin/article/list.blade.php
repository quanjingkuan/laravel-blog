@extends('admin.app')
        @section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/article')}}">文章管理</a> &raquo; 文章列表
    </div>
@if(session('ok'))
    <div class="mark" style="background: greenyellow;color: #fff;padding-left:20px;">
        <p>{{session('ok')}}</p>
    </div>
    @endif
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	{{--<div class="search_wrap">--}}
        {{--<form action="" method="post">--}}
            {{--<table class="search_tab">--}}
                {{--<tr>--}}
                    {{--<th width="120">选择分类:</th>--}}
                    {{--<td>--}}
                        {{--<select onchange="javascript:location.href=this.value;">--}}
                            {{--<option value="">全部</option>--}}
                            {{--<option value="http://www.baidu.com">百度</option>--}}
                            {{--<option value="http://www.sina.com">新浪</option>--}}
                        {{--</select>--}}
                    {{--</td>--}}
                    {{--<th width="70">关键字:</th>--}}
                    {{--<td><input type="text" name="keywords" placeholder="关键字"></td>--}}
                    {{--<td><input type="submit" name="sub" value="查询"></td>--}}
                {{--</tr>--}}
            {{--</table>--}}
        {{--</form>--}}
    {{--</div>--}}
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">

        <div class="result_wrap">
            <div class="result_title">
                <h3>分类管理</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部文章</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">ID</th>
                        <th>文章名称</th>
                        <th>文章出处</th>
                        <th>浏览次数</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($articles as $v)
                    <tr>
                        <td class="tc" style="width: 3%">{{$v->art_id}}</td>
                        <td style="width:">
                            <a href="#">{{$v->art_title}}</a>
                        </td>
                        <td>{{$v->art_editor}}</td>
                        <td>{{$v->art_view}}</td>
                        <td>{{date('Y:m:d',$v->art_time)}}</td>
                        <td>
                            <a href="{{url('admin/article/'.$v->art_id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="toDelete({{$v->art_id}});">删除</a>
                        </td>
                    </tr>
                        @endforeach
                </table>


<div class="page_nav">
{{$articles->links()}}
</div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->

    <script type="text/javascript">
            function toDelete(flied){
                layer.confirm('您确定要删除嘛？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    $.post("{{url('admin/article')}}/"+flied,
                            {
                                '_method':'DELETE',
                                '_token':'{{csrf_token()}}',
                                'id':flied
                            }
                            ,function(data){
                                if(data.status == 0){
                                    location.href = location.href;
                                    layer.msg(data.message,{icon:6});
                                }else{
                                    layer.msg(data.message,{icon:5});
                                }
                    });
                }, function(){

                });
            };
    </script>
@stop