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
                <h4 class="card-title"><b> 实习地点管理</b></h4>
                <div class="template-demo ">

                    <div class="row">
                        <div class="col-md-8">
                            <form class="form-sample" action=" {{url('user/fa')}}" method="post" >
                                {{csrf_field()}}
                                <div class="row">

                                    <div class="col-sm-3">
                                        <input type="text" name="sMajor" value="" class="form-control" placeholder="请输入实习地点或者实习地点编号"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit"  class="btn btn-inverse-primary btn-md">搜索</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <button id="addAddress" type="button" class="btn btn-inverse-primary btn-md">添加实习学校</button>
                        </div>
                    </div>
                </div>



            </div>

            {{--添加实习公司弹窗--}}
            <div style="background-color:beige;border-radius: 8px">
                <div class="card-body" id="form" style="{{count($errors) > 0?'':'display: none;'}}">
                    <h3 class="card-title"><b>添加实习公司</b></h3>

                    <p class="card-description">
                        请在下面 <code>输入框中</code> 填入实习公司相关信息
                    </p>

                    <form class="form-sample" action="{{url('/user/add')}}?type=201" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">公司编号</label>
                                    <div class="col-sm-9">

                                        <input type="text" name="te_account" class="form-control" placeholder="请输入实习公司编号"/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">公司名称</label>
                                    <div class="col-sm-9">

                                        <input type="text" name="te_name" class="form-control" placeholder="请输入公司名称"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">省份</label>
                                    <div class="col-sm-9">

                                        <input type="text" name="te_provice" class="form-control" placeholder="请选择省份"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">城市</label>
                                    <div class="col-sm-9">

                                        <input type="text" name="te_city" class="form-control" placeholder="请选择市区"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">详细地址</label>
                                    <div class="col-sm-9">

                                        <input type="text" name="te_address" class="form-control" placeholder="请输入公司详细地址"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">联系电话</label>
                                    <div class="col-sm-9">

                                        <input type="text" name="te_tel" class="form-control" placeholder="请输入公司联系方式"/>
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
                            学校编号
                        </th>
                        <th>
                            学校名称
                        </th>
                        <th>
                            所属省份
                        </th>
                        <th>
                            城市（区）
                        </th>
                        <th>
                            详细地址
                        </th>
                        <th>
                            联系电话
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
                    @foreach($result as $key =>$value)
                        <tr>
                            <td class="py-1">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input value="{{$value -> id}}" type="checkbox" class="form-check-input userid">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>{{$value->account  or "--"}}</td>
                            <td>{{$value->name  or "--"}}</td>
                            <td>{{$value->provice  or "--"}}</td>
                            <td>{{$value->city  or "--"}}</td>
                            <td>{{$value->address  or "--"}}</td>
                            <td>{{$value->tel  or "--"}}</td>
                            <td>{{  $value->creater_name  or "--"  }}</td>
                            <td>{{ $value -> created_at  or "--"  }}</td>
                            <td>

                                <button onclick="check(this)"  type="button" class="btn btn-inverse-success btn-sm"  uid="{{$value->id}}" uaccount="{{$value -> account }}"
                                        uprovice="{{$value -> provice }}"  ucity="{{$value -> city }}"  utel="{{$value -> tel }}"
                                        uname="{{$value->name}}"  uaddress="{{$value->address}}">修改</button>
                                <button onclick="disp_confirm(this)" delete="{{url('user/delAddress',['id'=>$value -> id])}}" type="button" class="btn btn-inverse-danger btn-sm">删除</button>
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
                            <button onclick="delAll(this)" delete="{{url('user/delAddress')}}" class="btn btn-inverse-danger btn-sm">删除</button>
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

    {{--修改教师模态框--}}
    <div class="modal fade" id="myModal" style="height: 800px; position: absolute;top: 50%;left: 50%;-webkit-transform: translate(-50%, -50%);-moz-transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);-o-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">
        <div class="row" >
            <div class="col-md-3"> </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">修改教师信息</h4>
                        <p class="card-description">
                            修改信息
                        </p>
                        <form class="forms-sample" action="{{url('/user/updateAddress')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">公司编号</label>
                                <div class="col-sm-9">
                                    <input type="hidden" id="uid" name="uid" class="form-control" value="">
                                    <input type="text" name="uaccount" id="uaccount" class="form-control" placeholder="请输入公司名称"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">公司名称</label>
                                <div class="col-sm-9">

                                    <input type="text" name="uname" id="uname" class="form-control" placeholder="请输入公司名称"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">省份</label>
                                <div class="col-sm-9">

                                    <input type="text" name="uprovice" id="uprovice" class="form-control" placeholder="请选择省份"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">城市</label>
                                <div class="col-sm-9">

                                    <input type="text" name="ucity" id="ucity" class="form-control" placeholder="请选择城市"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">具体地址</label>
                                <div class="col-sm-9">

                                    <input type="text" name="uaddress" id="uaddress" class="form-control" placeholder="请输入具体地址"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">联系方式</label>
                                <div class="col-sm-9">

                                    <input type="text" name="utel" id="utel" class="form-control" placeholder="请输入公司联系方式"/>
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
        var uprovice = $(e).attr('uprovice');
        var ucity = $(e).attr('ucity');
        var utel = $(e).attr('utel');
        var uname = $(e).attr('uname');
        var uaddress = $(e).attr('uaddress');
        //向模态框中传值
        $('#uid').val(id);
        $('#ucity').val(ucity);
        $('#uaccount').val(uaccount);
        $('#uprovice').val(uprovice);
        $('#uaddress').val(uaddress);
        $('#utel').val(utel);
        $('#uname').val(uname);

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

    //添加模块显示
    $('#addAddress').click(function () {
        $("#form").show();
    });


    //添加模块隐藏
    $('#close').click(function () {
        $('#form').hide();
    });
    $(function (){
        //隐藏修改教师模态框
        $("#closeUpdata").click(function(){
            $(".modal-backdrop").hide();
            $("#myModal").hide();
        });
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


    })

</script>
@stop