@extends('common.top')
@section('content')


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
                <h4 class="card-title">实习任务管理</h4>

                <div class="template-demo ">
                    <div class="row">
                        <div class="col-md-8">
                            <form class="form-sample" action="{{url('mission')}}" method="post" >
                                {{csrf_field()}}
                                <input value="teacher" name="role" type="hidden">

                                <div class="row">

                                    <div class="col-sm-5">
                                        <input type="text" name="name" value="" class="form-control" placeholder="请输入任务名"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit"  class="btn btn-inverse-primary btn-md">搜索</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <button id="addTeacher" type="button" class="btn btn-inverse-primary btn-md">添加任务</button>
                        </div>
                    </div>
                </div>
            </div>

            {{--添加任务弹窗--}}
            <div style="background-color:beige;border-radius: 8px">
                <div class="card-body" id="form" style="{{count($errors) > 0?'':'display: none;'}}">
                    <h3 class="card-title"><b>添加任务</b></h3>

                    <p class="card-description">
                        请在下面 <code>输入框中</code> 填入实习任务相关信息
                    </p>

                    <form class="form-sample" action="{{url('/mission/addMission')}}" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">任务名</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control" placeholder="请输入任务名"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">任务描述</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="descript" class="form-control" placeholder="请输入任务描述"/>
                                        <input type="hidden" name="num" class="form-control" value="1" placeholder="请输入任务数量"/>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-7">
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

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            任务名称
                        </th>{{--
                        <th>
                            数量
                        </th>--}}
                        <th>
                            任务内容
                        </th>{{--
                        <th>
                            状态
                        </th>--}}
                        <th>
                            创建人
                        </th>
                        <th>
                            创建时间
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result as $key => $value)
                    <tr>
                        <td>
                            {{$value->name or '--'}}
                        </td>
                   {{--     <td>
                            {{$value->num or '--'}}
                        </td>--}}
                        <td>
                            {{$value->descript or '--'}}
                        </td>
               {{--         <td>
                            @if($value->status == 0)

                                <label class="badge badge-danger">任务关闭中</label>
                                @elseif($value->status == 1)

                                <label class="badge badge-warning">任务开启中</label>
                                @else
                                --
                            @endif
                        </td>--}}
                        <td>
                            {{$value->creater_name or '--'}}
                        </td>
                        <td>
                            {{$value->created_at or '--'}}
                        </td>
                        <td>
{{--
                            <button onclick="check(this)" delete="{{url('/forum/del')}}" class="btn btn-inverse-success btn-sm">修改任务</button>--}}
                            <button onclick="devFroup(this)"  uid="{{$value->id}}" ugroupid="{{$value->group_id}}"  class="btn btn-inverse-info btn-sm">分配实习组</button>{{--
                            <button onclick="delAll(this)" delete="{{url('/forum/del')}}" class="btn btn-inverse-primary btn-sm">取消该任务</button>--}}
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{--修改论坛栏目模态框--}}
    <div class="modal fade" id="myModal" style="position: absolute;top: 50%;left: 50%;-webkit-transform: translate(-50%, -50%);-moz-transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);-o-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">
        <div class="row" >
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">分配实习组</h4>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    选择
                                    <input type="hidden" id="up_id" value="">
                                </th>
                                <th>
                                    实习小组编号
                                </th>
                                <th>
                                    实习小组名称
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($group as $key => $value)
                                <tr>
                                    <td class="py-1">

                                        <div class="form-check">

                                            <label class="form-check-label">
                                                @if(4)
                                                    <input value="{{$value->id}}" type="checkbox" class="form-check-input userid" checked="checked" >
                                                @else
                                                    <input value="{{$value->id}}" type="checkbox" class="form-check-input userid" checked="checked" >
                                                @endif
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


                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">

                                    <div class="form-check" style="margin-left: 15px">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" id="checkAllChange" checked="checked">
                                            全选
                                        </label>
                                    </div>

                                    <button onclick="delAll(this)" delete="{{url('/mission/devMission/')}}" class="btn btn-inverse-primary btn-sm">分配任务</button>
                                    <button id="closeUpdata" onclick="colseModal()" type="button" class="btn btn-light btn-sm">取消</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        {{--给实习小组分配任务模态框--}}
        function devFroup(e) {
            //获取表格中的一行数据
            var id = $(e).attr('uid');
            //向模态框中传值
            $('#up_id').val(id);

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



        {{--加载修改论坛栏目模态框--}}
        function check(e) {
            //获取表格中的一行数据
            var id = $(e).attr('uid');
            var name = $(e).attr('uname');
            var descript = $(e).attr('udescript');
            //向模态框中传值
            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_descript').val(descript);

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

        {{--分配任务确认--}}
        function delAll(e) {

            //批量删除
            var arrUserid = new Array();
            $(".userid").each(function(i) {
                if (this.checked == true) {
                    arrUserid[i] = $(this).val();
                }
            });
            for(var i = 0;i<arrUserid.length;i++){
                if(arrUserid[i]==''||arrUserid[i]==null||typeof(arrUserid[i])==undefined){
                    arrUserid.splice(i,1);
                    i=i-1;
                }
            }
            //alert("批量删除的:" + arrUserid);
            if(arrUserid.length==0){
                alert("请选择数据");
                return false;
            }else{
                var r=confirm('💗确认给这'+arrUserid.length+"个实习小组添加实习任务吗？");

                if (r==true)
                {
                    var id = $('#up_id').val();
                    var url= $(e).attr('delete')+"/"+arrUserid+"/"+id;
                    window.location.href=url;
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



            //添加论坛栏目模块显示
            $('#addTeacher').click(function () {
                $("#form").show();
            });
            //进入论坛
            $('#inForum').click(function () {

                window.location.href="/forumdet/index/";
            });
            //添加论坛栏目模块隐藏
            $('#close').click(function () {
                $('#form').hide();
            });
            //隐藏修改论坛栏目模态框
            $("#closeUpdata").click(function(){
                $(".modal-backdrop").hide();
                $("#myModal").hide();
            });

        })
    </script>
@stop