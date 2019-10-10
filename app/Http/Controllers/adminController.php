<<<<<<< HEAD
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function auth_admin()
    {
        if (Auth::user()->name != "venenof7") {
            die();
        }
    }

    public function seetask(Request $request)
    {
        $this->auth_admin();
        $task = DB::table('task')->get();
        return view('adminpage.task')->with('task', $task);

    }

    public function hide(Request $request, $id)
    {
        $this->auth_admin();
        $success = DB::table('task')->where('id', $id)->update(['check' => 'off']);
        if ($success) {
            $mess = "隐藏题目成功";
        } else {
            $mess = "因为某些原因失败";
        }
        return view('jump')->with([
            'message' => $mess,
            'url' => '/ctfadmin/task',
            'jumpTime' => 1,
        ]);

    }
    public function open(Request $request, $id)
    {
        $this->auth_admin();
<<<<<<< HEAD
        $success = DB::table('task')->where('id', $id)->update(['check' => 'off']);
=======
        $success = DB::table('task')->where('id', $id)->update(['check' => 'on']);
>>>>>>> a7c2db701f374e753728cf578c4cef2d80f38801
        if ($success) {
            $mess = "开放题目成功";
        } else {
            $mess = "因为某些原因失败";
        }
        return view('jump')->with([
            'message' => $mess,
            'url' => '/ctfadmin/task',
            'jumpTime' => 1,
        ]);

    }
    public function delete(Request $request, $id)
    {
        $this->auth_admin();
        $success = DB::table('task')->where('id', $id)->delete();
        if ($success) {
            $mess = "删除题目成功";
        } else {
            $mess = "因为某些原因失败";
        }
        return view('jump')->with([
            'message' => $mess,
            'url' => '/ctfadmin/task',
            'jumpTime' => 1,
        ]);

    }

    public function index(Request $request)
    {
        $this->auth_admin();
        $tasknum = DB::table('task')->select('id')->count();
        $people = DB::table('users')->select('id')->count();
        $submit = DB::table('submit_flag')->select('id')->count();
        $scorep = DB::table('solvedtask')->select('id')->count();
        return view('adminpage.index')->with(['tasknum' => $tasknum, 'people' => $people, 'submit' => $submit, 'scorep' => $scorep]);

    }

    public function hintadd(Request $request)
    {
        $this->auth_admin();
        if ($request->isMethod('get')) {
            $task = DB::table('task')->get();
            return view('adminpage.hint')->with('task', $task);
        } elseif ($request->isMethod('post')) {
            $taskname = $request->input('taskid');
            $taskdata = base64_encode($request->input('hintdata'));
            $success = DB::table('hint')->insert(
                ['taskid' => $taskname, 'hintdata' => $taskdata, 'addtime' => date("Y-m-d H:i:s")]
            );
            if ($success) {
                $mess = "添加hint成功";
            } else {
                $mess = "因为某些原因失败";
            }
            return view('jump')->with([
                'message' => $mess,
                'url' => '/ctfadmin/task/hint',
                'jumpTime' => 2,
            ]);
        }

    }

    public function addtask(Request $request)
    {
        $this->auth_admin();
        if ($request->isMethod('get')) {
            return view('adminpage.addtask');
        } elseif ($request->isMethod('post')) {
            $taskname = $request->input('taskname');
            $type = $request->input('type');
            $score = $request->input('score');
            $flag = $request->input('flag');
            $taskdata = base64_encode($request->input('taskdata'));
            $check = $request->input('check');
            $success = DB::table('task')->insert(
                ['taskname' => $taskname, 'typetask' => $type, 'taskdata' => $taskdata, 'check' => $check, 'fbuserid' => 0, 'flag' => $flag, 'score' => $score, 'addtime' => date("Y-m-d H:i:s")]
            );
            if ($success) {
                $mess = "添加成功";
            } else {
                $mess = "因为某些原因失败";
            }
            return view('jump')->with([
                'message' => $mess,
                'url' => '/ctfadmin/task/add',
                'jumpTime' => 2,
            ]);
        }
    }

    public function edittask(Request $request, $id)
    {
        $this->auth_admin();
        $task = DB::table('task')->where('id', $id)->get();
        $success1 = DB::table('task')->where('id', $id)->first();
        if ($success1) {
            if ($request->isMethod('get')) {
                return view('adminpage.edittask')->with('task', $task);
            } elseif ($request->isMethod('post')) {
                $taskname = $request->input('taskname');
                $type = $request->input('type');
                $score = $request->input('score');
                $flag = $request->input('flag');
                $taskdata = base64_encode($request->input('taskdata'));
                $check = $request->input('check');
                $success2 = DB::table('task')->where('id', $id)->update(
                    ['taskname' => $taskname, 'typetask' => $type, 'taskdata' => $taskdata, 'check' => $check, 'fbuserid' => 0, 'flag' => $flag, 'score' => $score, 'addtime' => date("Y-m-d H:i:s")]
                );
                if ($success2) {
                    $mess = "更新成功";
                } else {
                    $mess = "因为某些原因失败";
                }
                return view('jump')->with([
                    'message' => $mess,
                    'url' => '/ctfadmin/task',
                    'jumpTime' => 2,
                ]);
            }
        } else {
            $mess = "不存在当前题目";
        }
        return view('jump')->with([
            'message' => $mess,
            'url' => '/ctfadmin/task',
            'jumpTime' => 1,
        ]);
    }

    public function notice(Request $request)
    {
        $this->auth_admin();
        if ($request->isMethod('get')) {
            $notice = DB::table('notice')->get();
            return view('adminpage.notice')->with('notice', $notice);
        } elseif ($request->isMethod('post')) {
            $noticedata = base64_encode($request->input('noticedata'));
            $success = DB::table('notice')->insert(
                ['noticedata' => $noticedata, 'addtime' => date("Y-m-d H:i:s")]
            );
            if ($success) {
                $mess = "添加notice成功";
            } else {
                $mess = "因为某些原因失败";
            }
            return view('jump')->with([
                'message' => $mess,
                'url' => '/ctfadmin/notice',
                'jumpTime' => 2,
            ]);
        }
    }

    public function noticedelete(Request $request, $id){
        $this->auth_admin();
        $success = DB::table('notice')->where('id', $id)->delete();
        if ($success) {
            $refresh = DB::statement('alter table notice drop id');
            $refresh = DB::statement('alter table notice add id int(10) primary key auto_increment first');
            $mess = "删除notice成功";
        } else {
            $mess = "因为某些原因失败";
        }
        return view('jump')->with([
            'message' => $mess,
            'url' => '/ctfadmin/notice',
            'jumpTime' => 1,
        ]);
    }

    public function noticeedit(Request $request, $id){
        $this->auth_admin();
        $notice = DB::table('notice')->where('id', $id)->get();
        $success1 = DB::table('notice')->where('id', $id)->first();
        if ($success1) {
            if ($request->isMethod('get')) {
                return view('adminpage.editnotice')->with('notice', $notice);
            } elseif ($request->isMethod('post')) {
                $noticedata = $request->input('noticedata');
                $success2 = DB::table('notice')->where('id', $id)->update(
                    ['noticedata' => base64_encode($noticedata)]
                );
                if ($success2) {
                    $mess = "更新成功";
                } else {
                    $mess = "因为某些原因失败";
                }
                return view('jump')->with([
                    'message' => $mess,
                    'url' => '/ctfadmin/notice',
                    'jumpTime' => 2,
                ]);
            }
        } else {
            $mess = "不存在当前题目";
        }
        return view('jump')->with([
            'message' => $mess,
            'url' => '/ctfadmin/task',
            'jumpTime' => 1,
        ]);
    }

    public function seeteam(Request $request){
        $this->auth_admin();
        $team = DB::table('solvedtask')->get();
        return view('adminpage.team')->with('team', $team);
    }

    public function editteam(Request $request, $id)
    {
        $this->auth_admin();
        $team = DB::table('solvedtask')->where('id', $id)->get();
        $success1 = DB::table('solvedtask')->where('id', $id)->first();
        if ($success1) {
            if ($request->isMethod('get')) {
                return view('adminpage.editteam')->with('team', $team);
            } elseif ($request->isMethod('post')) {
                $teamkname = $request->input('teamname');
                $taskid = $request->input('taskid');
                $score = $request->input('score');
                $addtime = $request->input('addtime');
                $success2 = DB::table('solvedtask')->where('id', $id)->update(
                    ['username' => $teamkname, 'taskid' => $taskid,'score' => $score, 'addtime' => $addtime]
                );
                if ($success2) {
                    $mess = "更新成功";
                } else {
                    $mess = "因为某些原因失败";
                }
                return view('jump')->with([
                    'message' => $mess,
                    'url' => '/ctfadmin/team',
                    'jumpTime' => 2,
                ]);
            }
        } else {
            $mess = "不存在当前队伍";
        }
        return view('jump')->with([
            'message' => $mess,
            'url' => '/ctfadmin/team',
            'jumpTime' => 1,
        ]);
    }
   public function deleteteam(Request $request, $id)
    {
        $this->auth_admin();
        $success = DB::table('solvedtask')->where('id', $id)->delete();
        if ($success) {
            $mess = "删除队伍成功";
        } else {
            $mess = "因为某些原因失败";
        }
        return view('jump')->with([
            'message' => $mess,
            'url' => '/ctfadmin/team',
            'jumpTime' => 1,
        ]);

    }
}

=======
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
                <a href="/ctfadmin/task" class="nav-link tpl-left-nav-link-list active">
                    <i class="am-icon-bars"></i>
                    <span>题目列表</span></a>
        </li>

        <li class="tpl-left-nav-item">
                <a href="/ctfadmin/team" class="nav-link tpl-left-nav-link-list ">
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
            题目列表
        </div>
        <ol class="am-breadcrumb">
            <li><a href="/home" class="am-icon-home">首页</a></li>
            <li><a href="#">题目管理</a></li>
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
                                        <th class="table-title">Taskname</th>
                                        <th class="table-type">Type</th>
                                        <th class="table-date am-hide-sm-only">分值</th>
                                        <th class="table-date am-hide-sm-only">添加日期</th>
                                        <th class="table-set">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($task as $taskdata)
                                        <tr>
                                        <td>{{$taskdata -> id}}</td>
                                        <td>{{$taskdata -> taskname}}</td>
                                        <td><a href="#">{{$taskdata -> typetask}}</a></td>
                                        <td>{{$taskdata -> score}}</td>
                                        <td class="am-hide-sm-only">{{$taskdata -> addtime}}</td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><a href="{{url('ctfadmin/task/edit')}}/{{$taskdata->id}}"><span class="am-icon-pencil-square-o"></span> 编辑</a></button>
                                                   @php if($taskdata->check!='on'){
                                                        echo '<button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><a href="/ctfadmin/task/hide/'.$taskdata->id.'"><span class="am-icon-copy"></span>已隐藏<font color=red>☠</font></a></button>';
                                                    }else{echo '<button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><a href="/ctfadmin/task/hide/'.$taskdata->id.'"><span class="am-icon-copy"></span>显示中<font color=green>👁</font></a></button>';@endphp
                                                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><a href="{{url('ctfadmin/task/delete')}}/{{$taskdata->id}}"><span class="am-icon-trash-o"></span>删除</a></button>
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
>>>>>>> parent of a7c2db7... Update adminController.php
