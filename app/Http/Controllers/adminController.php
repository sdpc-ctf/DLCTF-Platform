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
        $success = DB::table('task')->where('id', $id)->update(['check' => 'off']);
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
?>
