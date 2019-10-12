@extends('common.forumTop')
@section('content')

        {{--热门板块123--}}

        @foreach($forum as $value_f)
        <div class="row">
            <div class="col-md-9">
                <h4> 当前所在版块：{{$value_f->name}}</h4>
                {{$value_f->descript}}
                </div>

            <div class="col-md-3">

                <button id="addTeacher" type="button" class="btn btn-inverse-primary btn-md">我要发贴</button>
                </div>
            </div>



        {{--发帖弹窗--}}
        <div style="background-color:beige;border-radius: 8px">
            <div class="card-body" id="form" style="{{count($errors) > 0?'':'display: none;'}}">
                <h3 class="card-title"><b>发帖</b></h3>

                <p class="card-description">
                    请在下面 <code>输入框中</code> 填入一楼详情哟，您将成为楼主呢
                </p>

                <form class="form-sample" action="{{url('forumdet/addForum')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">请输入帖子内容</label>
                                <div class="col-sm-9">
    <input type="hidden" name="forum_id" value="{{$value_f->id}}">
                                    <input style="width: 500px;height: 200px;" type="text" name="text" class="form-control" placeholder="请输入帖子内容"/>
                                </div>
                            </div>
                        </div>

                    </div>



                    <div class="row">

                        <div class="col-md-7">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-gradient-primary mb-2 ">提交</button>
                                </div>
                                <div class="col-sm-3">
                                    <button id="close" type="button" class="btn btn-light mb-2 ">取消</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>


        </div>

        @endforeach
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <h4 class="card-title">帖子列表</h4></div>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th >
                                        序号
                                    </th>
                                    <th>帖子标题</th>
                                    <th>
                                        发帖人
                                    </th>
                                    <th>
                                        发帖时间
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result as $k => $v)
                                    <tr>
                                        <td>
                                            {{$k+1}}
                                        </td>
                                        <td>
                                         <a href="{{url('/forumdet/reply/')}}/{{$v->id}}"> {{$v->text}}</a>
                                        </td>
                                        <td>
                                            {{$v->creater_name}}
                                        </td>
                                        <td>
                                            {{$v->create_time}}
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
    <script>
        $(function () {
            //添加论坛栏目模块显示
            $('#addTeacher').click(function () {
                $("#form").show();
            });

            //添加论坛栏目模块隐藏
            $('#close').click(function () {
                $('#form').hide();
            });
        })
    </script>
@stop