@extends('common.top')
@section('content')


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">评分</h4>
                <p class="card-description">
                </p>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            学号
                        </th>
                        <th>
                            姓名
                        </th>
                        <th>
                            任务名称
                        </th>
                        <th>
                            任务描述
                        </th>
                        <th>
                            已上传
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result as $key =>$value)

                            <tr>
                                <td>
                                    {{$value->stu_account or "--"}}
                                </td>
                                <td>
                                    {{$value->stu_name or "--"}}
                                </td>
                                <td>
                                    <input name="id" value="{{$value->id}}" type="hidden">
                                    <input name="miss_det_id" value="{{$value->miss_det_id}}" type="hidden">

                                    {{$value->name or "--"}}
                                </td>
                                <td>
                                    {{$value->descript or "--"}}
                                </td>
                                <td>
                                    @if($value->file_name==" ")
                                        还未上传文件
                                    @else
                                        已上传：  {{$value->file_name}}
                                        <a href="/download/{{$value->file_name}}">下载</a>
                                    @endif
                                </td>

                            </tr>
                    @endforeach
                    <tr>
                        <form  enctype="multipart/form-data"  method="post" action="{{url('mission/pingfen')}}" style="margin-bottom:12px; ">
                            {{csrf_field()}}

                            @foreach($result as $key =>$value)
                                <input name="stu_id" value="{{$value->stu_id}}" type="hidden">
                            @endforeach
                            <td colspan="3">
                                @if($stu_fenshu==" ")
                                    请评分: <input  style="width: 45px;" name="fenshu" type="text" value="">
                                    <button type="submit" class=" btn btn-gradient-primary btn-sm">提交</button>
                                @else
                                    已评分：  {{$stu_fenshu}}
                                @endif

                            </td>
                        <td colspan="5">
                        </td>

                        </form>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop