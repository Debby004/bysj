@extends('common.forumTop')
@section('content')

           {{--热门板块123--}}
            <div class="row">
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{asset('images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>
                            <h2 class="font-weight-normal mb-3">招聘专贴
                                <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                            </h2>这里有
                           <h2 class="card-text">18</h2>家公司发了新的招聘信息啦
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-info card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{asset('images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>
                            <h2 class="font-weight-normal mb-3">日常问题
                                <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                            </h2>这里有<h2 class="card-text">5</h2>个问题等待你的解答
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-success card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{asset('images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>
                            <h2 class="font-weight-normal mb-3">失物招领
                                <i class="mdi mdi-diamond mdi-24px float-right"></i>
                            </h2>
                            这里有<h2 class="card-text">6 </h2>件小可爱等待认领，是你的吗？
                        </div>
                    </div>
                </div>
            </div>

            {{--所有板块列表--}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">所有板块</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>

                                        </th>
                                        <th>
                                           板块名字
                                        </th>
                                        <th>
                                           板块介绍
                                        </th>
                                        <th>
                                           帖子总数
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($forum_list as $k1 => $v1)

                                        <tr>
                                            <td></td>
                                            <td>
                                                <a href="{{url('/forumdet/det/')}}/{{$v1->id}}"> {{$v1->name}}</a>
                                            </td>
                                            <td>
                                                {{$v1->descript}}
                                            </td>
                                            <td>13
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--新闻公告--}}

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <h4 class="card-title">新闻公告</h4></div>
                                <div class="col-md-5">
                                    <a href="#"><h4 class="card-title" style="float: right">更多新闻公告</h4></a></div>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th >
                                            公告
                                        </th>
<th>详情</th>
                                        <th>
                                            时间
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($news_list as $k => $v)
                                        <tr>
                                            <td>     {{$v->title}} </td>
                                            <td>     {{$v->text}} </td>
                                            <td  > {{$v->create_time}}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div></div></div>
                </div></div>
            {{--实习组列表--}}
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">实习组列表</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>编号
                                        </th>
                                        <th>
                                            名称
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
                                    @foreach($group_list as $k => $v)
                                        <tr>
                                            <td>
                                                {{$v->account}}
                                            </td>
                                            <td>
                                                {{$v->name}}
                                            </td>
                                            <td>
                                                {{$v->start_time}}
                                            </td>
                                            <td>
                                                {{$v->end_time}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@stop