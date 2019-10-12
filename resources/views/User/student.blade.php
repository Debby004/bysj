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
                <h4 class="card-title"><b> 学生管理</b></h4>
                <div class="template-demo ">
                    <div class="row">
                        <div class="col-md-8">
                            <form class="form-sample" action=" {{url('user/selUser')}}" method="post" >
                                {{csrf_field()}}
                                <input value="teacher" name="role" type="hidden">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <select class="form-control" name="faculty_id" id="se_faculty_id">

                                            <option value="0">请选择院系</option>

                                            @foreach($res as $key=>$sort)

                                                @if ($sort -> faculty_id =='')
                                                    <option name="faculty_id" value="{{$sort -> id}}" {{ $sort -> id==old('faculty_id')?'selected="selected"':''}}>{{ $sort -> name}} </option>;
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">

                                        <select class="form-control" id="se_major_id" name="se_major_id">
                                            <option  fid="0"  value="0" selected>请选择专业</option>
                                            @foreach($res as $key=>$sort)
                                                <option style="display: none" name="se_major_id" value="{{ $sort -> id}}" fid="{{ $sort -> faculty_id}}" >{{ $sort -> name}} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="hidden" name="role" value="student" class="form-control"/>
                                        <input type="text" name="sMajor" value="" class="form-control" placeholder="请输入学生姓名或者学号"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit"  class="btn btn-inverse-primary btn-md">搜索</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <button id="addStudent" type="button" class="btn btn-inverse-primary btn-md">添加学生</button>
                        </div>
                    </div>
                </div>

            </div>

            {{--添加学生弹窗--}}
            <div style="background-color:beige;border-radius: 8px">
                <div class="card-body" id="form" style="{{count($errors) > 0?'':'display: none;'}}">
                    <h3 class="card-title"><b>添加教师</b></h3>

                    <p class="card-description">
                        请在下面 <code>输入框中</code> 填入学生相关信息
                    </p>

                    <form class="form-sample" action="{{url('/user/add')}}?type=102" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">工号</label>
                                    <div class="col-sm-9">

                                        <input type="text" name="te_id" class="form-control" placeholder="请输入学生学号"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">姓名</label>
                                    <div class="col-sm-9">

                                        <input type="text" name="te_name" class="form-control" placeholder="请输入学生姓名"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">院系</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="te_faculty_id" name="te_faculty_id">
                                            <option value="0">请选择院系</option>

                                            @foreach($res as $key=>$sort)

                                                @if ($sort -> faculty_id =='')
                                                    <option name="te_faculty_id" value="{{ $sort -> id}}" {{ $sort -> id==old('faculty_id')?'selected="selected"':''}}>{{ $sort -> name}} </option>;
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">专业</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="te_major_id" name="te_major_id">
                                            <option  style="display: none" fid="0"  value="0" selected >请选择专业</option>

                                            @foreach($res as $key=>$sort)
                                                <option style="display: none" name="te_major_id" value="{{ $sort -> id}}" fid="{{ $sort -> faculty_id}}" >{{ $sort -> name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">手机号</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="te_tel" class="form-control" placeholder="请输入教师手机号"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">民族</label>
                                    <div class="col-sm-9">

                                        <input type="text" name="te_nation" class="form-control" placeholder="请输入民族"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">出生日期</label>
                                    <div class="col-sm-9">

                                        <input type="date" name="te_birth" class="form-control" placeholder="请选择出生日期"/>
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
                <table class="table table-striped" id="table">
                    <thead>
                    <tr>
                        <th>
                            全选
                        </th>
                        <th>
                            用户名[学号]
                        </th>
                        <th>
                            姓名
                        </th>
                        <th>
                            院系
                        </th>
                        <th>
                            专业
                        </th>
                        <th>
                            民族
                        </th>
                        <th>
                           出生年月
                        </th>
                        <th>
                            手机号
                        </th>
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


                    @foreach($result as $key=>$sort)

                        <tr>
                            <td class="py-1">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input value="{{$sort -> id}}" type="checkbox" class="form-check-input userid">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <input value="{{$sort -> id}}" name="id" type="hidden">
                                {{ $sort -> account  or  $sort -> name   }}
                            </td>
                            <td>
                                {{ $sort -> name   or "--" }}
                            </td>
                            <td>
                                {{ $sort -> faculty_name  or "--"  }}
                            </td>
                            <td>
                                {{ $sort -> major_name or "--"   }}
                            </td>
                            <td>
                                {{ $sort -> nation  or "--"   }}
                            </td>
                            <td>
                                {{ $sort -> birth  or "--"   }}
                            </td>
                            <td>
                                {{ $sort ->tel  or "--"  }}
                            </td>
                            <td>
                                {{ $sort -> creater_name  or "--"  }}
                            </td>
                            <td>
                                {{ $sort -> created_at or "--"   }}
                            </td>
                            <td>

                                <button onclick="check(this)"  type="button" class="btn btn-inverse-success btn-sm"  uid="{{$sort->id}}" uaccount="{{$sort -> account }}"
                                        unation="{{$sort -> nation }}"  ubirth="{{$sort -> birth }}"  utel="{{$sort -> tel }}"
                                        uname="{{$sort->name}}"  ufaculty_id="{{$sort->faculty_id}}" umajor_id="{{$sort->major_id}}">修改</button>
                                <button onclick="disp_confirm(this)" delete="{{url('user/delUser',['id'=>$sort -> id])}}" type="button" class="btn btn-inverse-danger btn-sm">删除</button>
                            </td>
                        </tr>
                    @endforeach
                    <tr rowspan="2">
                        <td>
                            <div class="form-check" style="margin-left: 15px">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" id="checkAllChange">
                                    全选
                                </label>
                            </div>
                            <button onclick="delAll(this)" delete="{{url('user/delUser')}}" class="btn btn-inverse-danger btn-sm">删除</button>
                        </td>

                        <td colspan="9"></td>
                        <td>
                      {{--      　　 <form enctype="multipart/form-data" method="post" id="fileUploadForm" action="{{url('user/add')}}?type=3" style="margin-bottom:12px; ">
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

    {{--修改学生模态框--}}
    <div class="modal fade" id="myModal" style="height: 800px; position: absolute;top: 50%;left: 50%;-webkit-transform: translate(-50%, -50%);-moz-transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);-o-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">
        <div class="row" >
            <div class="col-md-3"> </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">修改学生信息</h4>
                        <p class="card-description">
                            修改信息
                        </p>
                        <form class="forms-sample" action="{{url('/user/updateUser')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">工号</label>
                                <div class="col-sm-9">
                                    <input type="hidden" id="u_id" name="u_id" class="form-control" value="">
                                    <input type="hidden" id="u_role" name="u_role" class="form-control" value="teacher">
                                    <input type="text" name="uaccount" id="uaccount" class="form-control" placeholder="请输入学生学号"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">姓名</label>
                                <div class="col-sm-9">

                                    <input type="text" name="ute_name" id="uname" class="form-control" placeholder="请输入学生姓名"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">院系</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="ute_faculty_id" name="ute_faculty_id">
                                        <option  style="display: none"  value="0" selected >请选择院系</option>

                                        @foreach($res as $key=>$sort)
                                            @if ($sort -> faculty_id =='')
                                                <option name="ute_faculty_id" value="{{ $sort -> id}}" fid="{{ $sort -> id}}" >{{ $sort -> name}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">专业</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="ute_major_id" name="ute_major_id">
                                        <option  style="display: none" fid="0"  value="0" selected >请选择专业</option>
                                        @foreach($res as $key=>$sort)
                                            <option style="display: none" name="ute_major_id" value="{{ $sort -> id}}" fid="{{ $sort -> faculty_id}}"  mid="{{ $sort -> id}}" >{{ $sort -> name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">手机号</label>
                                <div class="col-sm-9">

                                    <input type="text" name="ute_tel" id="utel" class="form-control" placeholder="请输入学生手机号"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">民族</label>
                                <div class="col-sm-9">

                                    <input type="text" name="ute_nation" id="unation" class="form-control" placeholder="请输入民族"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">出生日期</label>
                                <div class="col-sm-9">

                                    <input type="date" name="ute_birth" id="ubirth" class="form-control" placeholder="请选择出生日期"/>
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


        {{--加载修改老师模态框--}}
        function check(e) {
            //获取表格中的一行数据
            var id = $(e).attr('uid');
            var uaccount = $(e).attr('uaccount');
            var unation = $(e).attr('unation');
            var ubirth = $(e).attr('ubirth');
            var utel = $(e).attr('utel');
            var uname = $(e).attr('uname');
            var ufaculty_id = $(e).attr('ufaculty_id');
            var umajor_id = $(e).attr('umajor_id');
            //向模态框中传值
            $('#u_id').val(id);
            $('#uaccount').val(uaccount);
            $('#unation').val(unation);
            $('#ubirth').val(ubirth);
            $('#utel').val(utel);
            $('#uname').val(uname);
            $('#ute_major_id option').css("display","none");
            $('#ute_faculty_id option').attr("selected",false);
            $('#ute_major_id option').attr("selected",false);
            $('#ute_faculty_id option[fid="'+ufaculty_id+'"]').attr("selected",true);
            $('#ute_major_id option[mid="'+umajor_id+'"]').attr("selected",true);
            $('#ute_major_id option[fid="'+ufaculty_id+'"]').css("display","block");

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
    //搜索教师选择院系时专业随之变化
    $('#se_faculty_id').change(function(){
        var sel=document.getElementById("se_faculty_id");
        var index = sel.selectedIndex; // 选中索引
        var albumid= sel.options[index].value;//要的值
        $('#se_major_id option').attr("selected",false);
        $('#se_major_id option[fid="'+"0"+'"]').css("display","block");
        $('#se_major_id option[fid="'+"0"+'"]').attr("selected",true);
        $('#se_major_id option').css('display','none');
        $('#se_major_id option[fid="'+albumid+'"]').css('display','block');
    });
    //添加教师选择院系时专业随之变化
    $('#te_faculty_id').change(function(){
        var sel=document.getElementById("te_faculty_id");
        var index = sel.selectedIndex; // 选中索引
        var albumid= sel.options[index].value;//要的值
        $('#te_major_id option').attr("selected",false);
        $('#te_major_id option[fid="'+"0"+'"]').css("display","block");
        $('#te_major_id option[fid="'+"0"+'"]').attr("selected",true);
        $('#te_major_id option').css('display','none');
        $('#te_major_id option[fid="'+albumid+'"]').css('display','block');
    });

    //修改教师选择院系时专业随之变化
    $('#ute_faculty_id').change(function(){
        var sel=document.getElementById("ute_faculty_id");
        var index = sel.selectedIndex; // 选中索引
        var albumid= sel.options[index].value;//要的值
        $('#ute_major_id option').attr("selected",false);
        $('#ute_major_id option[fid="'+"0"+'"]').css("display","block");
        $('#ute_major_id option[fid="'+"0"+'"]').attr("selected",true);
        $('#ute_major_id option').css('display','none');
        $('#ute_major_id option[fid="'+albumid+'"]').css('display','block');

    });

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
            //alert("批量删除的:" + arrUserid);
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
        //添加教师模块显示
        $('#addStudent').click(function () {
            $("#form").show();
        });
        //添加教师模块隐藏
        $('#close').click(function () {
            $('#form').hide();
        });
        //隐藏修改教师模态框
        $("#closeUpdata").click(function(){
            $(".modal-backdrop").hide();
            $("#myModal").hide();
        });
    })

 </script>
@stop