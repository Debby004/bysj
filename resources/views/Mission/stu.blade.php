@extends('common.top')
@section('content')


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">查看我的实习任务</h4>
                <p class="card-description">
                </p>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            任务名称
                        </th>
                        <th>
                            任务描述
                        </th>
                        <th>
                            已上传
                        </th>

                        <th>
                            上传材料
                        </th>
                        <td>提交</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result as $key =>$value)
                        <form  enctype="multipart/form-data"  method="post" action="{{url('mission/stuadd')}}" style="margin-bottom:12px; ">
                            {{csrf_field()}}
                        <tr>
                            <td>
                                <input name="id" value="{{$value->id}}" type="hidden">

                                {{$value->name or "--"}}
                            </td>
                            <td>
                                {{$value->descript or "--"}}
                            </td>
                            <td>
                                @if(empty($value->file_name))
                                    还未上传文件
                                      @else
                                  已上传：  {{$value->file_name}}
                                    <a href="/download/{{$value->file_name}}">下载</a>
                                @endif
                            </td>
                            <td>

                                <input name="file" type="file" value="上传材料">
                            </td>
                            <td>
                                <button type="submit" class=" btn btn-gradient-primary btn-sm">提交</button>
                            </td>
                        </tr>
                        </form>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop