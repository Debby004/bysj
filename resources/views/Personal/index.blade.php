@extends('common.top')
@section('content')


    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">个人信息修改</h4>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <p class="card-description">
                </p>
                <form class="forms-sample"  action="{{url('/user/updateUser')}}" method="post">
                    {{csrf_field()}}
                    @foreach($result as $key => $value)
                        <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">学号/工号/登录账号</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="uaccount" id="exampleInputUsername2" value="{{$value->account or ''}}"  placeholder="请输入学号/工号" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">姓名</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="u_id" value="{{$value->id }}">
                            <input type="hidden" name="ute_faculty_id" value="{{$value->faculty_id }}">
                            <input type="hidden" name="ute_major_id" value="{{$value->major_id }}">
                            <input type="text" class="form-control" name="ute_name" id="exampleInputUsername2" value="{{$value->name or ''}}"   placeholder="请输入姓名">
                        </div>
                    </div>
                        @if($value->role=='address')
                            <input type="hidden" class="form-control"  name="ute_birth"  id="exampleInputEmail2"  value=" "   placeholder="请选择出生年月">
                           <input type="hidden" class="form-control"  name="ute_nation"   id="exampleInputMobile" value=" "  placeholder="请输入民族">

                        @else
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">出生日期</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control"  name="ute_birth"  id="exampleInputEmail2"  value="{{$value->birth or ''}}"   placeholder="请选择出生年月">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">民族</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  name="ute_nation"   id="exampleInputMobile" value="{{$value->nation or ''}}"  placeholder="请输入民族">
                                </div>
                            </div>


                        @endif
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">手机号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ute_tel" id="exampleInputMobile" value="{{$value->tel or ''}}" placeholder="请输入电话" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">密码</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="exampleInputPassword2"  >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">再一次输入密码</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="exampleInputConfirmPassword2">
                            </div>
                        </div>


                    <button type="submit" class="btn btn-gradient-primary mr-2">提交</button>
                        @endforeach
                </form>
            </div>
        </div>
    </div>
@stop