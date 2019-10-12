@extends('common.top')
@section('content')
    <ul id="myTab" class="nav nav-tabs">
        <li class="active">
            <a href="#group_mess" data-toggle="tab">
                <button type="button" class="btn  btn-outline-primary btn-fw">查看实习组详细信息</button>
            </a>
        </li>
        <li><a href="#mission" data-toggle="tab"> <button type="button" class="btn  btn-outline-primary btn-fw">实习组实习任务</button></a></li>
        <li class="dropdown">
            <a href="#up_tea" tabindex="-1" data-toggle="tab"><button type="button" class="btn  btn-outline-primary btn-fw">实习组成员管理     <b class="caret "></b></button>

            </a>

        </li>
    </ul>
    <br/>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="group_mess">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">实习组详细信息</h4>
                        <form class="form-sample">

                            @foreach($group as $key=>$sort)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">实习组编号</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="groupId" readonly class="form-control" value="{{ $sort -> id   or "--" }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">实习组名称</label>
                                        <div class="col-sm-9">

                                            <input type="text"  readonly class="form-control" value="{{ $sort -> name   or "--" }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">类型</label>
                                        <div class="col-sm-9">
                                            @if($sort->type == '1')
                                                <input type="text"  readonly class="form-control" value="自主实习" />
                                            @elseif($sort->type=='2')
                                                <input type="text" readonly class="form-control" value="编队实习" />
                                            @else
                                                <input type="text"  readonly class="form-control" value="未知类型" />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">小组成员/限报人数	</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control" value="{{ $sort -> limit_count   or "--" }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">实习地点</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control" value="{{ $sort -> address_name   or "--" }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">指导老师</label>
                                        <div class="col-sm-9">

                                            <input type="text" readonly  class="form-control" value="{{ $sort -> led_teacher_name   or "--" }}" />
                                        </div>
                                </div>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">开始时间</label>
                                        <div class="col-sm-9">

                                            <input type="text"  readonly class="form-control" value="{{ $sort -> start_time   or "--" }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">结束时间</label>
                                        <div class="col-sm-9">

                                            <input type="text"  readonly class="form-control" value="{{ $sort -> end_time   or "--" }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">创建者</label>
                                        <div class="col-sm-9">

                                            <input type="text"  readonly class="form-control" value="{{ $sort -> creater_name   or "--" }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </form>
                    </div>
                </div>
            </div>



        </div>

        {{--实习组任务管理模块--}}
        <div class="tab-pane fade" id="mission">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">查看实习组任务</h4>
                        <p class="card-description">
                        </p>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    任务名称
                                </th>
                                <th>
                                    任务描述
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groupMission as $m => $mk)
                            <tr>
                                <td>
                                    {{$mk->name or "--"}}
                                </td>
                                <td>

                                    {{$mk->descript or "--"}}
                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




        </div>
        {{--实习组成员管理模块--}}
        <div class="tab-pane fade" id="up_tea">


            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">


                    <div class="card-body">
                        @foreach($group as $key=>$sort)

                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">实习组名称：【{{ $sort -> name   or "--" }}】</h4>       </div>
                                <div class="col-md-2">
                                    <button id="addAddress" type="button" class="btn btn-inverse-primary btn-md">修改实习地点</button>
                                </div>  <div class="col-md-2">
                                    <button id="addTeacher" type="button" class="btn btn-inverse-primary btn-md">修改指导老师</button>
                                </div>
                                <div class="col-md-2">
                                    <button id="addStudent" type="button" class="btn btn-inverse-primary btn-md">添加学生</button>
                                </div>
                            </div>
                        <br/>


                            {{--添加实习地点弹窗--}}
                            <div style="background-color:beige;border-radius: 8px">
                                <div class="card-body" id="formAddress" style="{{count($errors) > 0?'':'display: none;'}}">
                                    <h3 class="card-title"><b>选择实习地点</b></h3>

                                    <p class="card-description">
                                        请选择新的实习地点
                                    </p>


                                    <table class="table table-bordered">

                                        <thead>
                                        <tr>
                                            <th>
                                                选择
                                            </th>
                                            <th>
                                                实习地点编号
                                            </th>
                                            <th>
                                                实习地点名称
                                            </th>
                                            <th>
                                                地址
                                            </th>
                                            <th>
                                                电话
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($address as $key => $value)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input value="{{$value->id}}" type="checkbox" class="form-check-input group_address_id">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{$value->account or '--'}}
                                                </td>
                                                <td>
                                                    {{$value->name or '--'}}
                                                </td>
                                                <td>
                                                    {{$value->provice or '--'}}{{$value->city or '--'}}{{$value->address or '--'}}
                                                </td>
                                                <td>
                                                    {{$value->tel or '--'}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <br/>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <button  onclick="AddAddress(this)" delete="{{url('group/addAddress')}}"  class="btn btn-gradient-primary mb-2 ">提交</button>
                                                </div>
                                                <div class="col-sm-3">
                                                    <button id="closeAddress" type="button" class="btn btn-light mb-2 ">取消</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            {{--添加教师弹窗--}}
                            <div style="background-color:beige;border-radius: 8px">
                                <div class="card-body" id="formTea" style="{{count($errors) > 0?'':'display: none;'}}">
                                    <h3 class="card-title"><b>修改指导老师</b></h3>

                                    <p class="card-description">
                                        请选择新的指导老师
                                    </p>


                                    <table class="table table-bordered">

                                        <thead>
                                        <tr>
                                            <th>
                                                选择
                                            </th>
                                            <th>
                                                姓名
                                            </th>
                                            <th>
                                                工号
                                            </th>
                                            <th>
                                                学院
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($tea as $key => $value)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input value="{{$value->id}}" type="checkbox" class="form-check-input group_tea_userid">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{$value->name or '--'}}
                                                </td>
                                                <td>
                                                    {{$value->account or '--'}}
                                                </td>
                                                <td>
                                                    {{$value->faculty_name or '--'}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <br/>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <button  onclick="AddTea(this)" delete="{{url('group/addTea')}}"  class="btn btn-gradient-primary mb-2 ">提交</button>
                                                </div>
                                                <div class="col-sm-3">
                                                    <button id="closeTea" type="button" class="btn btn-light mb-2 ">取消</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            {{--添加学生弹窗--}}
                            <div style="background-color:beige;border-radius: 8px">
                                <div class="card-body" id="form" style="{{count($errors) > 0?'':'display: none;'}}">
                                    <h3 class="card-title"><b>添加学生</b></h3>

                                    <p class="card-description">
                                        选择要加入实习组的学生
                                    </p>


                                    <table class="table table-bordered">

                                        <thead>
                                        <tr>
                                            <th>
                                                选择
                                            </th>
                                            <th>
                                                姓名
                                            </th>
                                            <th>
                                                学号
                                            </th>
                                            <th>
                                                学院
                                            </th>
                                            <th>
                                                专业
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($stu as $key1 => $value1)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input value="{{$value1->id}}" type="checkbox" class="form-check-input group_stu_userid">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{$value1->name}}
                                                </td>
                                                <td>
                                                    {{$value1->account}}
                                                </td>
                                                <td>
                                                    {{$value1->faculty_name}}
                                                </td>
                                                <td>
                                                    {{$value1->major_name}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td  colspan="6">
                                                    <div class="form-check" style="margin-left: 15px">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" id="checkAllStudent">
                                                            全选
                                                        </label>

                                                    </div>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                    <br/>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <button  onclick="AddStu(this)"  abc="{{url('group/addStu')}}"   class="btn btn-gradient-primary mb-2 ">提交</button>
                                                </div>
                                                <div class="col-sm-3">
                                                    <button id="close" type="button" class="btn btn-light mb-2 ">取消</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>


                        <br/>


                        <table class="table table-bordered">

                            <thead>
                            <tr>
                                @foreach($group as $a22 =>$b22)
                                <td>实习公司：</td>
                                <td colspan="2">

                                        {{$b22->address_name or "--"}}
                                </td>
                                <td>地址：</td>
                                <td colspan="4">


                                        {{$b22->address_address or '--'}}
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                <th>
                                   选择
                                </th>
                                <th>
                                    姓名
                                </th>
                                <th>
                                    工号/学号
                                </th>
                                <th>
                                    类型
                                </th>
                                <th>
                                    学院
                                </th>
                                <th>
                                    专业
                                </th>
                                <th>
                                    评分
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($member as $a =>$b)
                            <tr>
                                <td class="py-1">

                                    @if($b->role == 'teacher')
                                        @else
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input value="{{$b->id}}" type="checkbox" class="form-check-input group_userid">
                                            <input value="{{$b->id}}" type="checkbox" class="form-check-input group_userid">
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                        </label>
                                    </div>
                                        @endif
                                </td>
                                <td>
                                    {{$b->name or "--"}}
                                </td>
                                <td>
                                    {{$b->account or "--"}}
                                </td>
                                <td>
                                    @if($b->role == 'teacher')
                                        教师
                                    @else
                                      学生
                                    @endif
                                </td>
                                <td>
                                    {{$b->faculty_name or "--"}}
                                </td>
                                <td>
                                    {{$b->major_name or "--"}}
                                </td>
                                <td>

                                    @if($b->role == 'teacher')
                                    @else

                                        <a href="{{url('mission/fenshu/')}}?stuid={{$b->id}}" class="btn btn-gradient-primary btn-sm">点此评分</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tr><td colspan="7">
                                    <div class="form-check" style="margin-left: 15px">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" id="checkAllChange">
                                            全选
                                        </label>
                                    </div>
                                    <button onclick="delAll(this)" delete="{{url('/group/delGroupUser')}}" class="btn btn-inverse-danger btn-sm">删除</button>
                                </td>
                            </tr>
                        </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>



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

        {{--添加实习地点到实习组--}}
        function AddAddress(e) {


            var group_address_id = new Array();
            $(".group_address_id").each(function(i) {
                if (this.checked == true) {
                    group_address_id[i] = $(this).val();
                }
            });
            for(var i = 0;i<group_address_id.length;i++){
                if(group_address_id[i]==''||group_address_id[i]==null||typeof(group_address_id[i])==undefined){
                    group_address_id.splice(i,1);
                    i=i-1;
                }
            }
            if(group_address_id.length==0){
                alert("请选择数据");
                return false;
            }else if(group_address_id.length>1){
                alert("只能选择一个实习地点老师");
                return false;

            }else {
                var r=confirm('💗确认添加该实习地点到实习组？添加至实习组后，原来的实习地点将被删除');

                if (r==true)
                {
                    var groupId = $('#groupId').val();
                    var id= $(e).attr('delete')+"/"+group_address_id+"/"+groupId;

                    window.location.href=id;
                }else
                {
                    return false;
                }

            }


        };
        {{--添加教师到实习组--}}
        function AddTea(e) {


            var group_tea_userid = new Array();
            $(".group_tea_userid").each(function(i) {
                if (this.checked == true) {
                    group_tea_userid[i] = $(this).val();
                }
            });
            for(var i = 0;i<group_tea_userid.length;i++){
                if(group_tea_userid[i]==''||group_tea_userid[i]==null||typeof(group_tea_userid[i])==undefined){
                    group_tea_userid.splice(i,1);
                    i=i-1;
                }
            }
            if(group_tea_userid.length==0){
                alert("请选择数据");
                return false;
            }else if(group_tea_userid.length>1){
                alert("只能选择一位老师");
                return false;

            }else {
                var r=confirm('💗确认添加该老师到实习组？添加至实习组后，原来的老师将不再带领该实习组');

                if (r==true)
                {
                    var groupId = $('#groupId').val();
                    var id= $(e).attr('delete')+"/"+group_tea_userid+"/"+groupId;

                    window.location.href=id;
                }else
                {
                    return false;
                }

            }


        };
        function AddStu(e) {


            var group_stu_userid = new Array();
            $(".group_stu_userid").each(function(i) {
                if (this.checked == true) {
                    group_stu_userid[i] = $(this).val();
                }
            });
            for(var i = 0;i<group_stu_userid.length;i++){
                if(group_stu_userid[i]==''||group_stu_userid[i]==null||typeof(group_stu_userid[i])==undefined){
                    group_stu_userid.splice(i,1);
                    i=i-1;
                }
            }

            if(group_stu_userid.length==0){
                alert("请选择数据");
                return false;
            }else {
                var r=confirm('💗确认添加该这'+group_stu_userid.length+'位学生到实习组？');

                if (r==true)
                {
                    var groupId = $('#groupId').val();
                    var url= $(e).attr('abc')+"/"+group_stu_userid+"/"+groupId;
                    window.location.href=url;
                }else
                {
                    return false;
                }

            }


        }
        {{--从实习组批量踢出学生--}}
        function delAll(e) {

            //批量删除
            var group_userid = new Array();
            $(".group_userid").each(function(i) {
                if (this.checked == true) {
                    group_userid[i] = $(this).val();
                }
            });
           // alert("批量删除的:" + group_userid);
           if(group_userid.length==0){
                alert("请选择数据");
                return false;
            }else{
                var r=confirm('💗确认将这些学生从实习组中删除吗？删除后数据无法恢复');

                if (r==true)
                {
                    var groupId = $('#groupId').val();
                    var id= $(e).attr('delete')+"/"+group_userid+"/"+groupId;
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
                    $(".group_userid").each(function() {
                        this.checked = true;
                    });
                } else {
                    $(".group_userid").each(function() {
                        this.checked = false;
                    });
                }
            });
            // 添加学生全选/取消全部
            $("#checkAllStudent").click(function() {
                if (this.checked == true) {
                    $(".group_stu_userid").each(function() {
                        this.checked = true;
                    });
                } else {
                    $(".group_stu_userid").each(function() {
                        this.checked = false;
                    });
                }
            });
            //添加教师模块显示
            $('#addStudent').click(function () {
                $("#form").show();
            });
            //添加教师模块隐藏
            $('#close').click(function () {
                $('#form').hide();
            });
            //添加实习地点模块显示
            $('#addAddress').click(function () {
                $("#formAddress").show();
            });
            //添加实习地点模块隐藏
            $('#closeAddress').click(function () {
                $('#formAddress').hide();
            });
            //添加教师模块显示
            $('#addTeacher').click(function () {
                $("#formTea").show();
            });
            //添加教师模块隐藏
            $('#closeTea').click(function () {
                $('#formTea').hide();
            });
            //隐藏修改教师模态框
            $("#closeUpdata").click(function(){
                $(".modal-backdrop").hide();
                $("#myModal").hide();
            });
        })

    </script>
@stop