@extends('common.top')
@section('content')


    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">发布招聘信息</h4>
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
                <form class="forms-sample"  action="{{url('fbzhaopin')}}" method="post">
                    {{csrf_field()}}

                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">请输入招聘简章</label>
                            <div class="col-sm-9">
                                <input  style="width: 500px;height: 500px" type="text" class="form-control" name="text" id="exampleInputMobile"  placeholder="请输入招聘简章" >
                            </div>
                        </div>



                        <button type="submit" class="btn btn-gradient-primary mr-2">提交</button>
                </form>
            </div>
        </div>
    </div>
@stop