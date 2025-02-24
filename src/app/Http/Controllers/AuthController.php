<?php

namespace App\Http\Controllers;

use App\Models\Break_time;
use App\Models\Situation;
use App\Models\Work;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;
use SebastianBergmann\CodeUnit\FunctionUnit;
use App\Http\Requests\ChangeRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Psy\CodeCleaner\FunctionContextPass;

class AuthController extends Controller
{
// 管理者
    // 勤怠一覧画面
    public function admin_index(){
        // $time_start = Carbon::createFromFormat('H:i', '10:00');
        // $time_end = Carbon::createFromFormat('H:i', '11:00');
        // $time_start2 = Carbon::createFromFormat('H:i', '15:00');
        // $time_end2 = Carbon::createFromFormat('H:i', '16:00');
        // $break = Carbon::createFromFormat('H:i', '00:00');
        // $diff = $time_start->diff($time_end);
        // $diff2 = $time_start2->diff($time_end2);
        // $addtime = Carbon::createFromTime($diff->h, $diff->i);
        // $addtime2 = Carbon::createFromTime($diff->h, $diff->i);
        // $break = $break->addHours($addtime->hour)->addMinutes($addtime->minute);
        // $break = $break->addHours($addtime2->hour)->addMinutes($addtime2->minute);
        $worklist = Work::whereDate('work_in', Carbon::now()->today())->with('user', 'break_times')->get();
        $list = Work::selectRaw('*, TIMEDIFF()');


        return view('admin.adminindex', compact('worklist'));
    }
    private function setList($worklist){
        $list = [];
        foreach($worklist as $work){
            // 休憩時間の算出
            $break = Carbon::createFromFormat('H:i', '00:00');
            foreach($work->break_times as $break_time){
                $starttime = Carbon::createFromFormat('H:i', $break_time->break_in);
                $endtime = Carbon::createFromFormat('H:i', $break_time->break_out);
                $diff = $starttime->diff($endtime);
                $addtime = Carbon::createFromFormat('H:i', $diff);
                $break = $break->addHours($addtime->hour)->addMinutes($addtime->minute);
            }
            $list[] = [
                'name' => $work->user->name,
                'clock_in' => $work->clock_in,
                'clock_out' => $work->clock_out,
            ];
        }
    }

    // 休憩時間算出メソッド
    private function breakTime($break_in, $break_out){
        $time_start = Carbon::createFromTime($break_in->h, $break_in->i);
        $time_end = Carbon::createFromTime($break_out->h, $break_out->i);
        $diff = $time_start->diff($time_end);
        $time_break = Carbon::createFromTime($diff->h, $diff->i);

        return $time_break;
    }

    // 勤務時間合計算出メソッド
    private function workTotal($clock_in, $clock_out, $break_time){
        $time_start = Carbon::createFromTime($clock_in->h, $clock_in->i);
        $time_end = Carbon::createFromTime($clock_out->h, $clock_out->i);
        $diff = $time_start->diff($time_end);
        $work_total = Carbon::createFromTime($diff->h, $diff->i);
        $work_total = $work_total->subHours($break_time->h)->subMinutes($break_time->i);

        return $work_total;
    }

    public function request_list(){
        return view('admin.request_list');
    }

//一般ユーザー
    // 勤怠登録
    public function index(){
        $situation = Situation::where('user_id', Auth::id())->first();

        return view('index', compact('situation'));
    }
    public function index_store(Request $request){
        // 出勤ボタン
        if ($request->has('attendance')) {
            Work::create(
                [
                    'user_id' => Auth::id(),
                    'work_in' => Carbon::now(),
                ]
            );
            Situation::find(Auth::id())->update(['situation' => 1]);
        }
        // 退勤ボタン
        elseif($request->has('leaving')){
            $this->searchWork()->update(
                ['work_out' => Carbon::now()],
            );
            Situation::find(Auth::id())->update(
                ['situation' => 3]
            );
        }
        // 休憩ボタン
        elseif($request->has('break_in')){
            $work = $this->searchWork()->first();
            Break_time::create(
                [
                    'work_id' => $work->id,
                    'break_in' => Carbon::now(),
                    ]
                );
            Situation::find(Auth::id())->update(
                ['situation' => 2]
            );
        }
        // 休憩戻ボタン
        elseif($request->has('break_out')){
            $work = $this->searchWork()->first();
            Break_time::where('work_id', $work->id)->latest('id')->update(
                [
                    'break_out' => Carbon::now(),
                ]
            );
            Situation::find(Auth::id())->update(
                ['situation' => 1]
            );
        }

        return redirect('/attendance');
    }
    // 検索処理
    private function searchWork(){
        $work = Work::where('user_id', Auth::id())->whereDate('work_in', Carbon::now()->today());

        return $work;
    }

    // 勤怠一覧
    public function work_list(){
        $user = Auth::user();
        $dateYm = Carbon::now()->format('Y-m');
        $worklist = Work::where('user_id', Auth::id())->whereMonth('work_in', Carbon::now()->format('m'))->with('break_times')->get();

        return view('admin.staffdetail', compact('user', 'dateYm', 'worklist'));
    }
    //勤怠詳細
    public function detail_index($work_id){
        $work = Work::find($work_id)->with('break_times', 'user')->first();

        return view('admin.admindetail', compact('work'));
    }
    public function detail_store($work_id, ChangeRequest $request){

    }
}