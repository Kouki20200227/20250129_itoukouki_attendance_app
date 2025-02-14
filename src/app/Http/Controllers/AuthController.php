<?php

namespace App\Http\Controllers;

use App\Models\Situation;
use App\Models\Working_day;
use App\Models\Working_hour;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        // dd($break->format('H:i'));
        $worklist = Working_hour::whereHas('working_day', function ($query) {
            $query->where('day', Carbon::today());
        })->with('user', 'break_times')->get();
        $list = Working_hour::selectRaw('*, TIMEDIFF()');


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


    // 勤怠登録
    public function index(){
        $situation = Situation::where('user_id', Auth::id())->first();

        return view('index', compact('situation'));
    }
    public function index_store(Request $request){
        // 出勤ボタン
        if($request->has('attendance')){
            // DBに今日の日付 有:find 無:create
            if(is_null(Working_day::where('day', today())->first())){
                $result = Working_day::create(['day' => today()]);
            }else{
                $result = Working_day::where('day', today())->first();
            }
            Working_hour::create([
                'user_id' => Auth::id(),
                'working_day_id' => $result->id,
                'clock_in' => Carbon::now()->format('H:i'),
            ]);
        }
        // 退勤ボタン
        elseif($request->has('leaving')){

        }
        // 休憩ボタン
        elseif($request->has('break_in')){

        }
        // 休憩戻ボタン
        elseif($request->has('break_out')){

        }

        return redirect('/attendance');
    }
}