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

                <div class="template-demo ">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title">新闻公告管理</h4>
                        </div>
                        <div class="col-md-4">
                            <button id="addTeacher" type="button" class="btn btn-inverse-primary btn-md">发布新的公告</button>
                        </div>
                    </div>
                </div>
            </div>

            {{--发消息弹窗--}}
            <div style="background-color:beige;border-radius: 8px">
                <div class="card-body" id="form" style="{{count($errors) > 0?'':'display: none;'}}">
                    <h3 class="card-title"><b>发布新的公告</b></h3>



                    <form class="form-sample" action="{{url('/news/addNews')}}" method="post">
                        {{csrf_field()}}

                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">主题</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="title" class="form-control" placeholder="请输入公告主题"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">内容</label>
                                    <div class="col-sm-8">
                                        <textarea type="text" name="text" class="form-control" placeholder="请输入公告内容"></textarea>
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
                            选择
                        </th>
                        <th>
                            主题
                        </th>
                        <th>
                            内容
                        </th>
                        <th>
                            时间
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($news_list as $k => $v)
                        <tr>
                            <td class="py-1">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input value="{{$v->id}}" type="checkbox" class="form-check-input userid">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                {{$v->title}}
                            </td>
                            <td>
                                {{$v->text}}
                            </td>
                            <td>
                                {{$v->create_time}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tr>
                        <td colspan="6">
                            <div class="form-check" style="margin-left: 15px">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" id="checkAllChange">
                                    全选
                                </label>
                            </div>
                            <button onclick="delAll(this)" delete="{{url('news/delNews')}}" class="btn btn-inverse-danger btn-sm">删除</button>
                        </td>
                        </td>
                    </tr>
                </table>
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
                var r=confirm('💗确认删除这'+arrUserid.length+"条公告吗？");

                if (r==true)
                {
                    var url= $(e).attr('delete')+"/"+arrUserid;
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