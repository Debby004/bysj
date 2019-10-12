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
                            院系
                        </th>
                        <th>
                            专业
                        </th>

                        <th>
                            评分
                        </th>
                        <td>提交</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result as $key =>$value)
                        <form  enctype="multipart/form-data"  method="post" action="{{url('mission/addressPingfen')}}" style="margin-bottom:12px; ">
                            {{csrf_field()}}

                            <input  style="width: 45px;" name="stu_id" type="hidden" value="{{$value->id or "--"}}">
                            <tr>
                                <td>
                                    {{$value->account or "--"}}
                                </td>
                                <td>
                                    {{$value->name or "--"}}
                                </td>
                                <td>

                                    {{$value->faculty_name or "--"}}
                                </td>
                                <td>
                                    {{$value->major_name or "--"}}
                                </td>
                                <td>
                                    @if($value->fenshu==" ")
                                        请评分: <input  style="width: 45px;" name="fenshu" type="text" value="">
                                    @else
                                        已评分：  {{$value->fenshu}}
                                    @endif

                                </td>
                                <td>
                                    @if($value->fenshu==" ")
                                        <button type="submit" class=" btn btn-gradient-primary btn-sm">提交</button>
                                    @else
                                    @endif
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