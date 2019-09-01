@extends('adminpage.home')
@section('content')
<div class="tpl-page-container tpl-page-header-fixed">
    <div class="tpl-left-nav tpl-left-nav-hover">
    <div class="tpl-left-nav-title">Amaze UI 列表</div>
    <div class="tpl-left-nav-list">
        <ul class="tpl-left-nav-menu">
        <li class="tpl-left-nav-item">
            <a href="/ctfadmin/home" class="nav-link">
            <i class="am-icon-home"></i>
            <span>首页</span></a>
        </li>
        <li class="tpl-left-nav-item">
                <a href="/ctfadmin/task" class="nav-link tpl-left-nav-link-list">
                    <i class="am-icon-bars"></i>
                    <span>题目列表</span></a>
        </li>

        <li class="tpl-left-nav-item">
                <a href="/ctfadmin/team" class="nav-link tpl-left-nav-link-list active">
                    <i class="am-icon-group"></i>
                    <span>队伍信息</span></a>
        </li>

        <li class="tpl-left-nav-item">
                <a href="/ctfadmin/task/add" class="nav-link tpl-left-nav-link-list">
                    <i class="am-icon-flag"></i>
                    <span>题目添加</span></a>
        </li>


        <li class="tpl-left-nav-item">
            <!-- 打开状态 a 标签添加 active 即可 -->
            <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
            <i class="am-icon-wpforms"></i>
            <span>Notice</span>
            <!-- 列表打开状态的i标签添加 tpl-left-nav-more-ico-rotate 图表即90°旋转 -->
            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
            </a>
            <!-- 打开状态 添加 display:block-->
            <ul class="tpl-left-nav-sub-menu">
            <li>
                <a href="/ctfadmin/task/hint" >
                <i class="am-icon-angle-right"></i>
                <span>题目hint</span>
                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                </a>
            </li>
                <li>
                    <a href="/ctfadmin/notice" >
                        <i class="am-icon-angle-right"></i>
                        <span>相关公告</span></a>
                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li class="tpl-left-nav-item">
            <a href="login.html" class="nav-link tpl-left-nav-link-list">
            <i class="am-icon-key"></i>
            <span>登出</span></a>
        </li>
        </ul>
    </div>
    </div>

    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            队伍信息
        </div>
        <ol class="am-breadcrumb">
            <li><a href="/home" class="am-icon-home">首页</a></li>
            <li><a href="#">队伍管理</a></li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 列表
                </div>
            </div>
            <div class="tpl-block">
                <div class="am-g">
                    <div class="am-u-sm-12">
                        <form class="am-form">
                            <table class="am-table am-table-striped am-table-hover table-main">
                                <thead>
                                    <tr>

                                        <th class="table-id">ID</th>
                                        <th class="table-title">Teamname</th>
                                        <th class="table-type">Solved</th>
                                        <th class="table-date am-hide-sm-only">分值</th>
                                        <th class="table-date am-hide-sm-only">最后提交</th>
                                        <th class="table-set">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($team as $teamdata)
                                        <tr>
                                        <td>{{$teamdata -> id}}</td>
                                        <td>{{$teamdata -> username}}</td>
                                        <td>{{$teamdata -> taskid}}</a></td>
                                        <td>{{$teamdata -> score}}</td>
                                        <td class="am-hide-sm-only">{{$teamdata -> addtime}}</td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><a href="{{url('ctfadmin/team/edit')}}/{{$teamdata->id}}"><span class="am-icon-pencil-square-o"></span> 编辑</a></button>
                                                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><a href="{{url('ctfadmin/team/delete')}}/{{$teamdata->id}}"><span class="am-icon-trash-o"></span>删除</a></button>
                                                    </div>
                                            </div>
                                        </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            <hr>

                        </form>
                    </div>

                </div>
            </div>
            <div class="tpl-alert"></div>
        </div>
</div>
</div>
@endsection
