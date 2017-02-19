@extends('admin.app')
        @section('title','配置列表－水萌信息后台管理')
@section('style')
    <script src="{{asset('uploadify3232mm/jquery.uploadify.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('uploadify3232mm/uploadify.css')}}">
    <style>
        .edui-default{line-height: 20px;}
        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
        {overflow: hidden; height:20px;}
        div.edui-box{overflow: hidden; height:22px;}

        .uploadify{display:inline-block;}
        .uploadify-button{border:none; border-radius:5px; margin-top:8px;
            background: greenyellow;}
        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
    </style>
    <script type="text/javascript">
        <?php $timestamp = time();?>
        $(function() {
                    $('#file_upload').uploadify({
                        'buttonText':'图片上传',
                        'formData'     : {
                            'timestamp' : '<?php echo $timestamp;?>',
                            '_token'     : "{{csrf_token()}}"
                        },
                        'swf'      : '{{asset('uploadify3232mm/uploadify.swf')}}',
                        'uploader' : '{{url('admin/upload')}}',
                        'onUploadSuccess':function(file,data,response){
                            $('#fodimg').val(data);
                        }
                    });
                });
    </script>
    <script src="{{asset('eyJpdiI6IjgwVVo2azd4aEVLV3I0ZXhVOFlWVVE9PSIsInZhbHVlIjoiRTBZTzVOSjBIbmFFc0VXYkVNZENtUT09IiwibWFjIjoiODBkYWNlMTMxM2FkNzMwYjUxODMzMWVkMTE5NTZjZGY5YjhiN2VhZDNkYTNjZmQ1Njk5ZTExZWFiOGRkODg4MSJ9/ueditor.config.js')}}"></script>
    <script src="{{asset('eyJpdiI6IjgwVVo2azd4aEVLV3I0ZXhVOFlWVVE9PSIsInZhbHVlIjoiRTBZTzVOSjBIbmFFc0VXYkVNZENtUT09IiwibWFjIjoiODBkYWNlMTMxM2FkNzMwYjUxODMzMWVkMTE5NTZjZGY5YjhiN2VhZDNkYTNjZmQ1Njk5ZTExZWFiOGRkODg4MSJ9/ueditor.all.min.js')}}"></script>
    <script src="{{asset('eyJpdiI6IjgwVVo2azd4aEVLV3I0ZXhVOFlWVVE9PSIsInZhbHVlIjoiRTBZTzVOSjBIbmFFc0VXYkVNZENtUT09IiwibWFjIjoiODBkYWNlMTMxM2FkNzMwYjUxODMzMWVkMTE5NTZjZGY5YjhiN2VhZDNkYTNjZmQ1Njk5ZTExZWFiOGRkODg4MSJ9/lang/zh-cn/zh-cn.js')}}"></script>
    @endsection
        @section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/article')}}">网站配置</a> &raquo; 配置列表
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

        <div class="result_wrap">
            <div class="result_title">
                <h3>配置管理</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>新增配置项</a>
                    <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>配置项列表</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <form action="{{url('admin/conf/changecontent')}}" method="post">
                    {{csrf_field()}}
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">排序</th>
                        <th class="tc" width="5%">ID</th>
                        <th width="8%">配置项标题</th>
                        <th width="5%">配置项名称</th>
                        <th width="55%">配置内容</th>
                        <th>操作</th>
                    </tr>
                    @foreach($conf as $v)
                        <tr>
                            <td class="tc">
                                <input type="text" name="ord[]" onchange="changeOrder(this,{{$v->conf_id}})" value="{{$v->conf_order}}">
                            </td>
                            <td class="tc">{{$v->conf_id}}</td>
                            <td>
                                <a href="#">{{$v->conf_title}}</a>
                            </td>
                            <td>{{$v->conf_name}}</td>
                            <td><input type="hidden" name="conf_id[]" value="{{$v->conf_id}}">{!! $v->_html !!}</td>
                            <td>
                                <a href="{{url('admin/config/'.$v->conf_id.'/edit')}}">修改</a>
                                <a href="javascript:;" onclick="toDelete({{$v->conf_id}});">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                    <div class="btn-group" style="margin:10px;">
                        <input type="submit" value="提交" style="line-height: 0;">
                        <input type="button" class="back" style="line-height: 0;" onclick="history.go(-1)" value="返回">
                    </div>
                </form>


<div class="page_nav">
</div>
            </div>
        </div>
    <!--搜索结果页面 列表 结束-->

    <script type="text/javascript">
            function toDelete(flied){
                layer.confirm('您确定要删除嘛？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    $.post("{{url('admin/config')}}/"+flied,
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
            function changeOrder (obj,conf_id) {
                var conf_order = $(obj).val();
$.post("{{ url('admin/conf/changeorder') }}",{
                '_token':'{{ csrf_token() }}',
                'conf_order':conf_order,
                'conf_id':conf_id,
            },function(data){
                   if(data.status == 0){
                       layer.msg(data.msg,{icon:6});
                   }else{
                       layer.msg(data.msg,{icon:5});
                   }

                });
            }
    </script>
@stop