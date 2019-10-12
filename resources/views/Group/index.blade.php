@extends('common.top')
@section('content')


    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h4 class="card-title"><b> 实习组管理</b></h4>
                    <div class="template-demo ">
                        <div class="row">
                            <div class="col-md-8">
                                <form class="form-sample" action=" {{url('/group')}}" method="post" >
                                    {{csrf_field()}}
                                    <input value="teacher" name="role" type="hidden">
                                    <div class="row">

                                        <div class="col-sm-4">
                                            <input type="text" name="name" value="" class="form-control" placeholder="请输入实习组名称或者实习组编号"/>
                                        </div>
                                        <div class="col-sm-5">
                                            <button type="submit"  class="btn btn-inverse-primary btn-md">搜索</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <button id="addTeacher" type="button" class="btn btn-inverse-primary btn-md">添加实习组</button>
                            </div>
                        </div>
                    </div>
                </div>



                {{--添加实习组弹窗--}}
                <div style="background-color:beige;border-radius: 8px">
                    <div class="card-body" id="form" style="{{count($errors) > 0?'':'display: none;'}}">
                        <h3 class="card-title"><b>新建实习组</b></h3>

                        <p class="card-description">
                            请在下面 <code>输入框中</code> 填入实习组相关信息
                        </p>

                        <form class="form-sample" action="{{url('/group/addGroup')}}" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">实习组编号</label>
                                        <div class="col-sm-9">

                                            <input type="text" name="account" class="form-control" placeholder="请输入实习组编号"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">实习组名字</label>
                                        <div class="col-sm-9">

                                            <input type="text" name="name" class="form-control" placeholder="请输入实习组名字"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">请选择实习类型</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="type">
                                                <option value="0">请选择实习类型</option>
                                                <option value="1">自主实习</option>
                                                <option value="2">编队实习</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">小组成员限报人数</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="limit_count" class="form-control" placeholder="请输入小组限报人数"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">实习组开始时间</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="start_time" class="form-control" placeholder="请选择实习组开始日期"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">实习组结束时间</label>
                                        <div class="col-sm-9">

                                            <input type="date" name="end_time" class="form-control" placeholder="请选择实习组结束日期"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-gradient-primary mb-2 ">提交</button>
                                        </div>
                                        <div class="col-sm-3">
                                            <button id="close" type="button" class="btn btn-light mb-2 ">取消</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>


                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>选择</th>
                            <th>实习组编号</th>
                            <th>实习组名字</th>
                            <th>指导老师</th>
                            <th>实习公司名称</th>
                            <th>开始时间</th>
                            <th>结束时间</th>
                           {{-- <th>状态</th>--}}
                            <th>创建者</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($group as $key =>$value)
                        <tr>
                            <td class="py-1">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input value=" {{$value->id}}" type="checkbox" class="form-check-input userid">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </label>
                                </div>
                            </td>
                            <td><a href="/group/update_t_s/{{$value->id}}">{{$value->account}}</a></td>
                            <td><a href="/group/update_t_s/{{$value->id}}">{{$value->name}}</a></td>

                            <td>{{$value->led_teacher_name}}</td>
                            <td>{{$value->address_name}}</td>
                            <td>{{$value->start_time}}</td>
                            <td>{{$value->end_time}}</td>
                            {{--<td class="text-success"> 82.00% <i class="mdi mdi-arrow-up"></i></td>--}}
                            {{--<td class="text-danger"> 28.76% <i class="mdi mdi-arrow-down"></i></td>--}}
                 {{--           <td>
                                @if($value->type=='1')
                                    <label class="badge badge-info">Fixed</label>
                                @elseif($value->type=='2')
                                    <label class="badge badge-warning">In progress</label>
                                @elseif($value->type=='3')
                                    <label class="badge badge-danger">Pending</label>
                                @elseif($value->type==' ')
                                    <label class="badge badge-success">Completed</label>
                                @endif
                            </td>--}}
                            <td>{{$value->creater_name}}</td>
                            <td>
                                <button onclick="check(this)"  type="button" class="btn btn-inverse-success btn-sm"  uid="{{$value->id}}" uaccount="{{$value -> account }}" uname="{{$value -> name }}"
                                        utype="{{$value -> type }}" ulimit_count="{{$value -> limit_count }}" ustart_time="{{$value -> start_time }}" uend_time="{{$value -> end_time }}">修改</button>
                                <button onclick="disp_confirm(this)" delete="{{url('group/delGroup',['id'=>$value -> id])}}" type="button" class="btn btn-inverse-danger btn-sm">删除</button>
                            </td>

                        </tr>
                        @endforeach

                        <tr rowspan="3">
                            <td>
                                <div class="form-check" style="margin-left: 15px">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" id="checkAllChange">
                                        全选
                                    </label>
                                </div>
                                <button onclick="delAll(this)" delete="{{url('group/delGroup')}}" class="btn btn-inverse-danger btn-sm">删除</button>
                            </td>
                            <td colspan="6"></td>
                            <td colspan="3">
                           {{--     <form enctype="multipart/form-data" method="post" id="fileUploadForm" action="{{url('user/add')}}?type=3" style="margin-bottom:12px; ">
                                    {{csrf_field()}}
                                    <input type="file" name="file" id="file" style="display: none;" onchange="fileUpload()">
                                </form>
                                <a href="{{asset('/templet/faculty.xls')}}">下载模板</a>
                                <button onclick="insertF()" class="btn btn-inverse-success btn-sm">批量导入</button>
                                <button onclick="exportF(this)" delete="{{url('/export/index')}}" class="btn btn-inverse-primary btn-sm">导出数据</button>--}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--修改教师模态框--}}
    <div class="modal fade" id="myModal" style="height: 800px; position: absolute;top: 50%;left: 50%;-webkit-transform: translate(-50%, -50%);-moz-transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);-o-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">
        <div class="row" >
            <div class="col-md-3"> </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">修改实习组信息</h4>
                        <p class="card-description">
                            修改信息
                        </p>
                        <form class="forms-sample" action="{{url('/group/update')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">实习组编号</label>
                                <div class="col-sm-9">
                                    <input type="hidden" id="up_id" name="up_id" class="form-control" value="">
                                    <input type="text" name="up_account" id="up_account" class="form-control" placeholder="请输入实习组编号"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">实习组名称</label>
                                <div class="col-sm-9">

                                    <input type="text" name="up_name" id="up_name" class="form-control" placeholder="请输入实习组名称"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">实习类型</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="up_type" name="up_type">
                                        <option value="0" typeid="0">请选择实习类型</option>
                                        <option value="1" typeid="1">自主实习</option>
                                        <option value="2" typeid="2">编队实习</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">小组限报人数</label>
                                <div class="col-sm-9">

                                    <input type="text" name="up_limit_count" id="up_limit_count" class="form-control" placeholder="请输入小组限报人数"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">请选择实习开始日期</label>
                                <div class="col-sm-9">

                                    <input type="date" name="up_start_time" id="up_start_time" class="form-control" placeholder="请选择实习开始日期"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">请选择实习结束日期</label>
                                <div class="col-sm-9">

                                    <input type="date" name="up_end_time" id="up_end_time" class="form-control" placeholder="请选择实习结束日期"/>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-gradient-primary mr-2">提交</button>
                            <button id="closeUpdata" onclick="colseModal()" type="button" class="btn btn-light">取消</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        {{--加载修改实习小组模态框--}}
        function check(e) {
            //获取表格中的一行数据
            var id = $(e).attr('uid');
            var account = $(e).attr('uaccount');
            var name = $(e).attr('uname');
            var type = $(e).attr('utype');
            var limit_count = $(e).attr('ulimit_count');
            var start_time = $(e).attr('ustart_time');
            var end_time = $(e).attr('uend_time');
            //向模态框中传值
            $('#up_id').val(id);
            $('#up_account').val(account);
            $('#up_name').val(name);
            $('#up_type option[typeid="'+type+'"]').attr("selected",true);
            $('#up_limit_count').val(limit_count);
            $('#up_start_time').val(start_time);
            $('#up_end_time').val(end_time);

            //加载模态框
            $(".modal-backdrop").show();
            $("#myModal").show();
            $('#myModal').modal();

        }
        {{--隐藏模态框--}}
        function colseModal() {
            $('#myModal').modal('hide');
            return false;
        }

        {{--单个删除 确认--}}
        function disp_confirm(e){
            var r=confirm('💗确认删除吗？删除后数据无法恢复');

            if (r==true)
            {
                window.location.href=$(e).attr('delete');
            }
            else
            {
            }
        }

        {{--批量删除--}}
        function delAll(e) {

            //批量删除
            var arrUserid = new Array();
            $(".userid").each(function(i) {
                if (this.checked == true) {
                    arrUserid[i] = $(this).val();
                }
            });
//            alert("批量删除的:" + arrUserid);
            if(arrUserid.length==0){
                alert("请选择数据");
                return false;
            }else{
                var r=confirm('💗确认删除这些数据吗？删除后数据无法恢复');

                if (r==true)
                {
                    var id= $(e).attr('delete')+"/"+arrUserid;

                    window.location.href=id;
                }else
                {
                    return false;
                }

            }


        }
        $(function () {
            // 全选/取消全部
            $("#checkAllChange").click(function() {
                if (this.checked == true) {
                    $(".userid").each(function() {
                        this.checked = true;
                    });
                } else {
                    $(".userid").each(function() {
                        this.checked = false;
                    });
                }
            });



            //添加实习小组模块显示
            $('#addTeacher').click(function () {
                $("#form").show();
            });
            //添加实习小组模块隐藏
            $('#close').click(function () {
                $('#form').hide();
            });
            //隐藏修改实习小组模态框
            $("#closeUpdata").click(function(){
                $(".modal-backdrop").hide();
                $("#myModal").hide();
            });

        })
    </script>
@stop