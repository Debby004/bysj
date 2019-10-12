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
                    <h4 class="card-title">实习平台论坛管理</h4>
                <p class="card-description">
                    论坛栏目管理 <code></code>
                </p>
                <div class="template-demo ">
                    <div class="row">
                        <div class="col-md-8">
                            <form class="form-sample" action="{{url('forum')}}" method="post" >
                                {{csrf_field()}}
                                <input value="teacher" name="role" type="hidden">

                                <div class="row">

                                    <div class="col-sm-3">
                                        <input type="text" name="name" value="" class="form-control" placeholder="请输入论坛主题"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit"  class="btn btn-inverse-primary btn-md">搜索</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <button id="addTeacher" type="button" class="btn btn-inverse-primary btn-md">添加论坛栏目</button>
                            <button id="inForum" type="button" class="btn btn-inverse-primary btn-md">进入论坛</button>
                        </div>
                    </div>
                </div>
            </div>

            {{--添加论坛栏目弹窗--}}
            <div style="background-color:beige;border-radius: 8px">
                <div class="card-body" id="form" style="{{count($errors) > 0?'':'display: none;'}}">
                    <h3 class="card-title"><b>添加论坛栏目</b></h3>

                    <p class="card-description">
                        请在下面 <code>输入框中</code> 填入论坛栏目相关信息
                    </p>

                    <form class="form-sample" action="{{url('/forum/add')}}" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">论坛栏目</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control" placeholder="请输入论坛栏目"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">论坛描述</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="descript" class="form-control" placeholder="请输入论坛描述"/>
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
                <table class="table">
                    <thead>
                    <tr>
                        <th>选择</th>
                        <th>标题</th>
                        <th>描述</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($forum as $key =>$value)
                    <tr>
                        <td class="py-1">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value=" {{$value->id}}" type="checkbox" class="form-check-input userid">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                </label>
                            </div>
                        </td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->descript}}</td>
                        <td>2019.3.19</td>
                        <td>

                            <button onclick="check(this)" uid="{{$value->id}}" uname="{{$value->name}}"  udescript="{{$value->descript}}"  type="button" class="btn btn-inverse-success btn-sm">修改</button>
                            <button onclick="disp_confirm(this)" delete="{{url('/forum/del',['id'=>$value -> id])}}" type="button" class="btn btn-inverse-danger btn-sm">删除</button>
                        </td>
                    </tr>
                    @endforeach
                    <tr >
                        <td>
                            <div class="form-check" style="margin-left: 15px">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" id="checkAllChange">
                                    全选
                                </label>
                            </div>
                            <button onclick="delAll(this)" delete="{{url('/forum/del')}}" class="btn btn-inverse-danger btn-sm">删除</button>
                        </td>
                        <td colspan="3"></td>
                        <td>
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

    {{--修改论坛栏目模态框--}}
    <div class="modal fade" id="myModal" style="position: absolute;top: 50%;left: 50%;-webkit-transform: translate(-50%, -50%);-moz-transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);-o-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">
        <div class="row" >
            <div class="col-md-3"> </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">修改论坛栏目</h4>

                        <form class="forms-sample" action="{{url('/forum/update')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">论坛栏目名称</label>
                                <div class="col-sm-9">
                                    <input type="hidden" id="up_id" name="up_id" class="form-control">
                                    <input type="text" id="up_name"  name="up_name"  class="form-control"  >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputEmail2"  class="col-sm-3 col-form-label">论坛描述</label>
                                <div class="col-sm-9">
                                    <input type="text" id="up_descript"  name="up_descript" class="form-control" >
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