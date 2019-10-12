@extends('common.top')
@section('content')
    <div class="row">

        <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">实习成绩统计</h4>
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
                            指导老师评分
                        </th>
                        <th>
                            实习公司带队老师评分
                        </th>
                        <th>
                            总分
                        </th>
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
                                     {{$value->fenshu_add}}

                                </td>
                                <td>
                                     {{$value->fenshu_led}}

                                </td>
                                <td>
                                     {{$value->zongfen}}

                                </td>
                            </tr>
                        </form>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            </div>
    </div>
    <div class="row">

        <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">就业信息统计</h4>
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
                            就业公司
                        </th>
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
                                     {{$value->address_name or "--"}}

                                </td>
                            </tr>
                        </form>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            </div>
    </div>{{--
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">实习人数</h4>
                    <canvas id="lineChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">实习地点</h4>
                    <canvas id="barChart" style="height:230px"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">实习成绩</h4>
                    <canvas id="areaChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">实习老师</h4>
                    <canvas id="doughnutChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>
    </div>--}}


@stop