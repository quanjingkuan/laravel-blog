@extends('admin.app')
        @section('style')
            <script src="{{asset('uploadify3232mm/jquery.uploadify.min.js')}}" type="text/javascript"></script>
            <link rel="stylesheet" type="text/css" href="{{asset('uploadify3232mm/uploadify.css')}}">
            <style>
                .edui-default{line-height: 20px;}
                div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                {overflow: hidden; height:20px;}
                div.edui-box{overflow: hidden; height:22px;}

                .uploadify{display:inline-block;}
                .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
            </style>
            <script src="{{asset('eyJpdiI6IjgwVVo2azd4aEVLV3I0ZXhVOFlWVVE9PSIsInZhbHVlIjoiRTBZTzVOSjBIbmFFc0VXYkVNZENtUT09IiwibWFjIjoiODBkYWNlMTMxM2FkNzMwYjUxODMzMWVkMTE5NTZjZGY5YjhiN2VhZDNkYTNjZmQ1Njk5ZTExZWFiOGRkODg4MSJ9/ueditor.config.js')}}"></script>
            <script src="{{asset('eyJpdiI6IjgwVVo2azd4aEVLV3I0ZXhVOFlWVVE9PSIsInZhbHVlIjoiRTBZTzVOSjBIbmFFc0VXYkVNZENtUT09IiwibWFjIjoiODBkYWNlMTMxM2FkNzMwYjUxODMzMWVkMTE5NTZjZGY5YjhiN2VhZDNkYTNjZmQ1Njk5ZTExZWFiOGRkODg4MSJ9/ueditor.all.min.js')}}"></script>
            <script src="{{asset('eyJpdiI6IjgwVVo2azd4aEVLV3I0ZXhVOFlWVVE9PSIsInZhbHVlIjoiRTBZTzVOSjBIbmFFc0VXYkVNZENtUT09IiwibWFjIjoiODBkYWNlMTMxM2FkNzMwYjUxODMzMWVkMTE5NTZjZGY5YjhiN2VhZDNkYTNjZmQ1Njk5ZTExZWFiOGRkODg4MSJ9/lang/zh-cn/zh-cn.js')}}"></script>
        @endsection
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="{{url('admin/article')}}">文章管理</a> &raquo; 添加文章
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/article/'.$art->art_id)}}" method="post">
            {{method_field('PUT')}}
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>所属分类：</th>
                        <td>
                            <select name="cate_id">
                                @foreach($data as $p)
                                <option value="{{$p->cate_id}}">{{$p->_cate_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>文章标题：</th>
                        <td>
                            <input type="text" class="lg" name="art_title" value="{{$art->art_title}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class=""></i>文章简介：</th>
                        <td>
                            <input type="text" class="lg" name="art_info" value="{{$art->art_info}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class=""></i>文章作者：</th>
                        <td>
                            <input type="text" class="sm" name="art_editor" value="{{$art->art_editor}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class=""></i>文章标签：</th>
                        <td>
                            <input type="text" class="sm" name="art_tags" value="{{$art->art_tags}}">
                            <span><i class="fa fa-exclamation-circle red">用逗号隔开</i></span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class=""></i>文章缩略图：</th>
                        <td>
                            <input type="text" name="art_thumb" size="50" value="@if($art->art_thumb != null){{$art->art_thumb}}@else暂无缩略图@endif">
                            <input id="file_upload"  type="file" multiple="true" >
                            <i class="fa fa-exclamation-circle red">请不要上传非法文件，如已上传请刷新页面重新上传</i>
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
                                                    $('input[name=art_thumb]').val(data);
                                                    $('#art_img_show').attr('src','../../'+data);
                                                }
                                            });
                                        });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <img src="{{$art->art_thumb}}" alt="" id="art_img_show" style="max-width: 350px;max-height: 100px;">
                        </td>
                    </tr>
                    <tr>
                        <th><i class=""></i>文章内容：</th>
                        <td>
                            <script id="editor" name="art_content" style="width:700px;height:300px;">{!!$art->art_content!!}</script>
                            <script>
                                var ue =UE.getEditor('editor');
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <th>浏览次数</th>
                        <td>
                            <input type="text" class="sm" name="art_view" value="{{$art->art_view}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i></span>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="require">*</i>关键词</th>
                        <td>
                            <input type="text" class="lg" name="art_keyword" value="{{$art->art_keyword}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>seo</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>描述</th>
                        <td>
                            <input type="text" class="lg" name="art_description" value="{{$art->art_description}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>seo</span>
                        </td>
                    </tr>

                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
@stop