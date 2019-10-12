@extends('common.top')
@section('content')


    <div class="col-md-8 grid-margin stretch-card">
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
                <h4 class="card-title">就业信息填写</h4>
                <p class="card-description">
                </p>
                <form class="forms-sample"  action="{{url('/user/addAddress')}}" method="post">
                    {{csrf_field()}}

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">公司名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="account" id="exampleInputUsername2" placeholder="请输入公司编号"  >
                                <span style="font-size: smaller">请自己随意搭配6-8位数字与字母的组合</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">公司名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="exampleInputUsername2" placeholder="请输入公司名称"  >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">公司地址</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  name="provice"   id="exampleInputMobile" placeholder="请输入公司所在省" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">公司地址</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  name="city"   id="exampleInputMobile" placeholder="请输入公司所在市" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">公司地址</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  name="address"   id="exampleInputMobile" placeholder="请输入公司详细地址" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">公司联系人</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="contacts" id="exampleInputMobile" placeholder="请输入公司联系人" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">联系人电话</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="tel" id="exampleInputMobile" placeholder="请输入联系人电话" >
                            </div>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary mr-2">提交</button>
                </form>
            </div>
        </div>
    </div>
@stop