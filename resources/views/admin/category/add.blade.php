@extends('admin.app')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">分类管理</a> &raquo; 添加分类
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
                <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部分类</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/category')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>父级分类：</th>
                        <td>
                            <select name="cate_pid">
                                <option value="0">==请选择==</option>
                                @foreach($data as $p)
                                <option value="{{$p->cate_id}}">{{$p->cate_name}}</option>
                                @endforeach
                            </select>
                            <span><i class="fa fa-exclamation-circle yellow"></i>默认是父级分类</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>分类名称：</th>
                        <td>
                            <input type="text" class="lg" name="cate_name">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>
                    <tr>
                        <th>查看次数</th>
                        <td>
                            <input type="text" class="sm" name="cate_view">
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="require">*</i>关键词</th>
                        <td>
                            <input type="text" class="lg" name="cate_keywoed">
                            <span><i class="fa fa-exclamation-circle yellow"></i>seo</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>描述</th>
                        <td>
                            <input type="text" class="lg" name="cate_desction">
                            <span><i class="fa fa-exclamation-circle yellow"></i>seo</span>
                        </td>
                    </tr>
                    <tr>
                        <th>排序</th>
                        <td>
                            <input type="text" class="sm" name="cate_order" value="0">
                            <span><i class="fa fa-exclamation-circle yellow"></i></span>
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