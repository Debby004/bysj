@extends('common.top')
@section('content')


    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">网站配置</h4>

                <form  enctype="multipart/form-data"  method="post" action="{{url('setting/add')}}" style="margin-bottom:12px; ">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputName1">学校名称</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="text" placeholder="请输入学校名称">
                    </div>

                    <div class="form-group">
                        <label>网站图标</label>

                        <input name="file" type="file" value="图片">

                    </div>

                    <button type="submit" class="btn btn-gradient-primary mr-2">提交</button>
                    <button class="btn btn-light">取消</button>
                </form>
            </div>
        </div>
    </div>
@stop