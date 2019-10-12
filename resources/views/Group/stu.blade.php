@extends('common.top')
@section('content')


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">查看我的实习小组</h4>
                <p class="card-description">
                </p>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            实习组编号
                        </th>
                        <th>
                            实习组名称
                        </th>
                        <th>
                            开始时间
                        </th>
                        <th>
                            结束时间
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result as $key =>$value)
                    <tr>
                        <td>

                           {{$value->account or "--"}}
                        </td>
                        <td>
                            {{$value->name or "--"}}
                        </td>
                        <td>
                            {{$value->start_time or "--"}}
                        </td>
                        <td>
                            {{$value->end_time or "--"}}
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop