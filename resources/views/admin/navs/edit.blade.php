@extends('admin.app')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">自定义导航管理</a> &raquo; 修改自定义导航
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
                <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>新增自定义导航</a>
                <a href="{{url('admin/navs')}}"><i class="fa fa-recycle"></i>导航列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/navs/'.$nav->nav_id)}}" method="post">
            {{method_field('put')}}
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>

                <tr>
                    <th><i class="require">*</i>导航名称</th>
                    <td>
                        <input type="text" class="lg" name="nav_name" value="{{$nav->nav_name}}">
                    </td>
                </tr>
                <tr>
                    <th>导航别名</th>
                    <td>
                        <input type="text" class="lg" name="nav_alias"  value="{{$nav->nav_title}}">
                    </td>
                </tr>

                <tr>
                    <th><i class="require">*</i>链接地址</th>
                    <td>
                        <input type="text" class="lg" name="nav_url" value="{{$nav->nav_url}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>#</span>
                    </td>
                </tr>
                <tr>
                    <th>排序</th>
                    <td>
                        <input type="text" class="sm" name="nav_order" value="{{$nav->nav_order}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i></span>
                    </td>
                </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交" style="line-height: 0;">
                            <input type="button" class="back" style="line-height: 0;" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
@stop