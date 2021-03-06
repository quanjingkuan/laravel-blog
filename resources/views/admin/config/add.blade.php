@extends('admin.app')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
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
                <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>返回列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/config')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>

                    <tr>
                        <th><i class="require">*</i>配置项标题</th>
                        <td>
                            <input type="text" class="md" name="conf_title">

                            <span><i class="fa fa-exclamation-circle yellow"></i>配置项名称必填</span>
                        </td>
                    </tr>

                    <tr>
                        <th>配置项名称</th>
                        <td>
                            <input type="text" class="md" name="conf_name">

                            <span><i class="fa fa-exclamation-circle yellow"></i>变量名</span>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="require">*</i>配置项类型</th>
                        <td>
                            <input type="radio" class="sm" name="field_type" value="input" checked onclick="showTr();">input &nbsp;
                            <input type="radio" class="sm" name="field_type" value="textarea" onclick="showTr();">textarea &nbsp;
                            <input type="radio" class="sm" name="field_type" value="radio" onclick="showTr();">radio
                            <input type="radio" class="sm" name="field_type" value="file" onclick="showTr();">file

                        </td>
                    </tr>
                    <tr class="field_value">
                        <th><i class="require">*</i>配置项值</th>
                        <td>
                            <input type="text" class="lg" name="field_value" value="">

                            <span><i class="fa fa-exclamation-circle yellow"></i>只有在radio情况下才需要填写，格式：1|开启,0|关闭</span>
                        </td>
                    </tr>
                    <tr>
                        <th>配置项说明</th>
                        <td>
                            <input type="text" class="lg" name="conf_tips">

                            <span><i class="fa fa-exclamation-circle yellow"></i>说明</span>
                        </td>
                    </tr>
                    <tr>
                        <th>排序</th>
                        <td>
                            <input type="text" class="sm" name="conf_order" value="0">
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
<script>
    $('.field_value').css('display','none');
        function showTr(){

            var type = $('input[name=field_type]:checked').val();
            if(type == 'radio'){
                $('.field_value').show();
            }else{
                $('.field_value').hide();
            }

        }
</script>
@stop