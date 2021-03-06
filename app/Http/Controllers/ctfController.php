<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ctfController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
            }
    public function challenges(Request $request)
    {
        $user_solve = DB::table('solvedtask')->where('username',Auth::user()->name)->first();

        $hint = DB::table('hint')
            ->join('task', 'hint.taskid', '=', 'task.id')
            ->select('hint.*', 'task.taskname')
            ->orderBy('addtime','desc')
            ->get();
        $hint_task = DB::table('hint')->pluck('taskid')->toArray();
        if($user_solve != NULL){
        $solced=json_decode($user_solve->taskid,true);}else{
        $solced=array();
        }
        $web=DB::table('task')->where('check','!=','on')->get();
        $solvenum1=DB::table('submit_flag')
                ->select('taskid', DB::raw('count(*) as count'))
                ->where('check_status',1)
                ->groupBy('taskid')
                ->havingRaw('taskid > 0')
                ->get()
                ->map(function ($value) {return (array)$value;})->toArray();
	$solvenum=array_column($solvenum1,'taskid');
        $slovenum2=array_column($solvenum1,'count');
	$solvenum=array_combine($solvenum,$slovenum2);
	return view('ctf.challenge')->with([
        'web'=>$web,'solved'=>$solced,'hint'=>$hint,'hinttask'=>$hint_task,'solvenum'=>$solvenum
        ]);
    }
    public function ctftype(Request $request,$type)
    {
        $user_solve = DB::table('solvedtask')->where('username',Auth::user()->name)->first();

        $hint = DB::table('hint')
            ->join('task', 'hint.taskid', '=', 'task.id')
            ->select('hint.*', 'task.taskname')
            ->orderBy('addtime','desc')
            ->get();
        $hint_task = DB::table('hint')->pluck('taskid')->toArray();
        if($user_solve != NULL){
        $solced=json_decode($user_solve->taskid,true);}else{
        $solced=array();
        }
	$web=DB::table('task')->where([
    ['typetask','=',$type],
    ['check','!=','on'],])->get();
	$solvenum1=DB::table('submit_flag')
                ->select('taskid', DB::raw('count(*) as count'))
                ->where('check_status',1)
                ->groupBy('taskid')
                ->havingRaw('taskid > 0')
                ->get()
                ->map(function ($value) {return (array)$value;})->toArray();
        $solvenum=array_column($solvenum1,'taskid');
        $slovenum2=array_column($solvenum1,'count');
	$solvenum=array_combine($solvenum,$slovenum2);
	return view('ctf.challenge')->with([
          'web'=>$web,'solved'=>$solced,'hint'=>$hint,'hinttask'=>$hint_task,'solvenum'=>$solvenum
        ]);
    }
    public function score(Request $request)
    {
        $user_solve = DB::table('solvedtask')->orderBy('score','desc')->get();
        $tasklist = DB::table('task')->get();
        return view('ctf.score')->with([
        'ranklist'=>$user_solve,'task'=>$tasklist
        ]);
    }
    public function about(Request $request)
    {
        return view('ctf.about');
    }
    public function notice(Request $request)
    {
        $data = DB::table('hint')
            ->select('hintdata','addtime');
        $data = DB::table('notice')
            ->union($data)
            ->select('noticedata as data','addtime')
            ->orderby('addtime','asc')
            ->get();

        return view('ctf.notice')->with([
            'data'=>$data
        ]);
    }
        public function index(Request $request)
    {
        return view('ctf.index');
    }
    public function submitflag(Request $request)
    {
        $submitflag=$request->input('flag');
        $id=$request->input('id');
        $flag=DB::table('task')->where('id',$id)->first();
        if($flag->flag == $submitflag){
          if($flag->fbuserid == 0){
          DB::table('task')->where('id',$id)->update(['fbuserid' => Auth::user()->id]);
          }
        $submit=DB::table('solvedtask')->where('username',Auth::user()->name)->first();
          if($submit != NULL){
              $user_solve = DB::table('solvedtask')->where('username',Auth::user()->name)->first();
              $solced=json_decode($user_solve->taskid,true);
              if(!in_array($id,$solced)){
                  echo '1';
            $submit_add=json_decode($submit->taskid, true);
            $newarr=array_merge($submit_add,array($id));
            $new_json=json_encode($newarr);
            DB::table('submit_flag')->insert(
            ['username'=>Auth::user()->name, 'taskid' => $id, 'check_status' => 1,  'addtime'=>date("Y-m-d H:i:s")]
            );
            DB::table('solvedtask')->where('username', Auth::user()->name)->increment('score',$flag->score,['taskid' => $new_json,'addtime'=>date("Y-m-d H:i:s")]);
            }else{
            echo '2';
            }
          }else{
            $flagarray=array($id);
            $flagjson=json_encode($flagarray);
            DB::table('solvedtask')->insert(['username' => Auth::user()->name,'taskid' => $flagjson, 'score' => $flag->score, 'addtime'=>date("Y-m-d H:i:s")]);
            DB::table('submit_flag')->insert(['username'=>Auth::user()->name, 'taskid' => $id, 'check_status' => 1,  'addtime'=>date("Y-m-d H:i:s")]);
          }
        }else{

        DB::table('submit_flag')->insert(
            ['username'=>Auth::user()->name, 'taskid' => $id, 'check_status' => 0, 'addtime'=>date("Y-m-d H:i:s")]
          );
        echo '0';
        }

    }
}
