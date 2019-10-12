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
                <h4 class="card-title"><b> 院系专业管理</b></h4>
                    <div class="template-demo ">

                        <div class="row">
                            <div class="col-md-8">
                                <form class="form-sample" action=" {{url('user/fa')}}" method="post" >
                                    {{csrf_field()}}
                                <div class="row">
                                        <div class="col-sm-3">
                                            <select class="form-control" name="faculty_id">

                                                <option value="0">请选择院系</option>

                                                @foreach($res as $key=>$sort)

                                                    @if ($sort -> faculty_id =='')
                                                        <option name="faculty_id" value="{{$sort -> id}}" {{ $sort -> id==old('faculty_id')?'selected="selected"':''}}>{{ $sort -> name}} </option>;
                                                    @endif

                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-3">
                                              <input type="text" name="sMajor" value="" class="form-control" placeholder="请输入专业"/>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="submit"  class="btn btn-inverse-primary btn-md">搜索</button>
                                        </div>
                                </div>
                            </form>
                            </div>
                            <div class="col-md-4">
                                <button id="addFaculty" type="button" class="btn btn-inverse-primary btn-md">添加院系</button>
                                <button id="addMajor" type="button" class="btn btn-inverse-primary btn-md">添加专业</button>
                            </div>
                        </div>
                    </div>


                </div>


                {{--添加院系弹窗--}}
            <div style="background-color:beige;border-radius: 8px">
            <div class="card-body" id="form" style="{{$errors->first('nameFaculty')?'':'display: none;'}}">
                    <h3 class="card-title"><b>添加院系</b></h3>

                    <p class="card-description">
                        请在下面 <code>输入框中</code> 填入院系名称
                    </p>

                <form class="form-sample" action="{{url('/user/add')}}?type=1" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">院系</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nameFaculty" class="form-control"  placeholder="请输入院系"/>
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


                {{--添加专业弹窗--}}
            <div class="card-body"   id="addMajorForm" style="{{$errors->first('names')?'':'display: none;'}}">

                    <h3 class="card-title"><b>添加专业</b></h3>

                    <p class="card-description">
                        请在下面 <code>下拉框中</code> 选择院系, &nbsp;&nbsp;
                        并在下面 <code>输入框中</code> 填入专业名称
                    </p>

                <form class="form-sample" action="{{url('/user/add')}}?type=2'" method="post">
                    {{csrf_field()}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">院系</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="faculty_id">
                                    <option value="">请选择院系</option>

                                    @foreach($res as $key=>$sort)

                                        @if ($sort -> faculty_id =='')
                                             <option name="faculty_id" value="{{ $sort -> id}}" {{ $sort -> id==old('faculty_id')?'selected="selected"':''}}>{{ $sort -> name}} </option>;
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">专业</label>
                                <div class="col-sm-9">
                                    <input type="text" name="names" class="form-control" placeholder="请输入专业"/>
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
                                    <button id="closeMajor" type="button" class="btn btn-light mb-2 ">取消</button>
                                </div>
                            </div>
                        </div>
                    </div>

            </form>



            </div>
            </div>


                {{--院系专业显示表格--}}
            <div class="card-body">
                <table class="table table-striped" id="table">
                    <thead>
                    <tr>
                        <th>
                            全选
                        </th>
                        <th>
                            院系
                        </th>
                        <th>
                            专业
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
                             {{ $sort -> faculty_name  or  $sort -> name   }}
                            </td>
                            <td>
                                {{ $sort -> faculty_id  ?  $sort -> name:"--"   }}
                            </td>
                            <td>
                                {{ $sort -> create_name  or "--"  }}
                            </td>
                            <td>
                                {{ $sort -> created_at or "--"   }}
                            </td>
                            <td>

                                <button onclick="check(this)" uid="{{$sort->id}}" uname="{{$sort->faculty_name}}"  ufaculty_name="{{$sort->name}}"  type="button" class="btn btn-inverse-success btn-sm">修改</button>
                                <button onclick="disp_confirm(this)" delete="{{url('user/del',['id'=>$sort -> id])}}" type="button" class="btn btn-inverse-danger btn-sm">删除</button>
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
                                <button onclick="delAll(this)" delete="{{url('user/del')}}" class="btn btn-inverse-danger btn-sm">删除</button>
                            </td>
                            <td colspan="4"></td>
                            <td>
                            　　 <form enctype="multipart/form-data" method="post" id="fileUploadForm" action="{{url('user/add')}}?type=3" style="margin-bottom:12px; ">
                                     {{csrf_field()}}
                                    <input type="file" name="file" id="file" style="display: none;" onchange="fileUpload()">
                                </form>
                                <a href="{{asset('/templet/faculty.xls')}}">下载模板</a>
                                    <button onclick="insertF()" class="btn btn-inverse-success btn-sm">批量导入</button>
                                    <button onclick="exportF(this)" delete="{{url('/export/index')}}" class="btn btn-inverse-primary btn-sm">导出数据</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

{{--修改院系模态框--}}
<div class="modal fade" id="myModal" style="position: absolute;top: 50%;left: 50%;-webkit-transform: translate(-50%, -50%);-moz-transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);-o-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">
    <div class="row" >
        <div class="col-md-3"> </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">修改院系专业</h4>
                        <p class="card-description">
                            修改院系
                        </p>
                        <form class="forms-sample" action="{{url('/user/update')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">院系</label>
                                <div class="col-sm-9">
                                    <input type="hidden" id="id" name="id" class="form-control">
                                    <input type="text" id="faculty" readonly name="faculty"  class="form-control" placeholder="请输入院系">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputEmail2"  class="col-sm-3 col-form-label">专业</label>
                                <div class="col-sm-9">
                                    <input type="text" id="major" readonly name="major" class="form-control" placeholder="请输入专业">
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
<script type="text/javascript">
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

        $("#addFaculty").click(function(){
            $("#addMajorForm").hide();
            $("#form").show();
        });
        $("#close").click(function(){
            $("#form").hide();
            $("#addMajorForm").hide();
        });
        $("#addMajor").click(function(){
            $("#form").hide();
            $("#addMajorForm").show();
        });
        $("#closeMajor").click(function(){
            $("#form").hide();
            $("#addMajorForm").hide();
        });
        $("#closeUpdata").click(function(){
            $(".modal-backdrop").hide();
            $("#myModal").hide();
        });

    });
{{--加载修改院系模态框模态框--}}
    function check(e) {
        //获取表格中的一行数据
        var id = $(e).attr('uid');
        var name = $(e).attr('uname');
        var faculty_name = $(e).attr('ufaculty_name');

        //如果是院系，不可以修改其他  如果是专业，不可以修改院系
        if(faculty_name==name){
            $('#faculty').removeAttr("readOnly");
            $('#major').attr("readOnly","true");
            $('#major').val("--");
        }else {
            $('#faculty').attr("readOnly","true");
            $('#major').removeAttr("readOnly");
            $('#major').val(faculty_name);
        }
        //向模态框中传值
        $('#id').val(id);
        $('#faculty').val(name);

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
{{--删除 确认--}}
    function disp_confirm(e){
        var r=confirm('💗确认删除吗？删除后数据无法恢复\u000d💗如果删除院系，院系下的所有专业也将被删除');

        if (r==true)
        {
            window.location.href=$(e).attr('delete');
        }
        else
        {
        }
    }
{{--导出数据--}}
    function exportF(e){
            window.location.href=$(e).attr('delete');
    }
{{--批量导入院系--}}
    function insertF(e){
      $("#file").trigger("click");
    }
    //文件上传
    function fileUpload() {
        $("#fileUploadForm").submit();

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
                var r=confirm('💗确认删除这些数据吗？删除后数据无法恢复\u000d💗如果删除院系，院系下的所有专业也将被删除');

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







</script>
@stop