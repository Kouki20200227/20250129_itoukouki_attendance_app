<?php

namespace App\Http\Controllers;

use App\Models\Break_time;
use App\Models\Situation;
use App\Models\Work;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;
use SebastianBergmann\CodeUnit\FunctionUnit;
use App\Http\Requests\ChangeRequest;
use App\Models\Change_request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Psy\CodeCleaner\FunctionContextPass;
use Symfony\Component\Console\Input\Input;

use function PHPUnit\Framework\isNull;

class AuthController extends Controller
{
// 管理者
    // 勤怠一覧画面
    public function admin_index(Request $request){
        switch($request->input('date')){
            case 'back':
                $result = Carbon::parse($request->dateYmd)->subDay();
                break;
            case 'next':
                $result = Carbon::parse($request->dateYmd)->addDay();
                break;
            default:
                $result = Carbon::now();
                break;
        }
        $worklist = Work::whereDate('work_in', $result->format('Y-m-d'))->with('user', 'break_times')->get();
        $works = $this->setList($worklist);
        $date = $result;

        return view('admin.adminindex', compact('works', 'date'));
    }
    // スタッフ一覧
    public function staff_list(){
        $users = User::all();

        return view('admin.stafflist', compact('users'));
    }
    // スタッフ別勤怠一覧
    public function staff_detail($user_id, Request $request){
        switch($request->input('date')){
            case 'back':
                $result = Carbon::parse($request->dateYm)->subMonth();
                break;
            case 'next':
                $result = Carbon::parse($request->dateYm)->addMonth();
                break;
            default:
                $result = Carbon::now();
                break;
        }
        $user = User::find($user_id)->first();
        $worklist = Work::where('user_id', $user_id)->whereMonth('work_in', $result->format('m'))->with('break_times')->get();
        $dateYm = $result->format('Y-m');

        return view('admin.staffdetail', compact('user', 'dateYm', 'worklist'));
    }


    // 勤務時間算出メソッド
    private function setList($worklist){
        $list = [];
        foreach($worklist as $work){
            $workdiff = Carbon::parse($work->work_in)->diff(Carbon::parse($work->work_out));
            $worktime = Carbon::createFromTime($workdiff->h, $workdiff->i);
            // 休憩時間の算出
            $break = Carbon::createFromFormat('H:i', '00:00');
            foreach($work->break_times as $break_time){
                $starttime = Carbon::parse($break_time->break_in);
                $endtime = Carbon::parse($break_time->break_out);
                $diff = $starttime->diff($endtime);
                $addtime = Carbon::createFromTime($diff->h, $diff->i);
                $break->addHours($addtime->hour)->addMinutes($addtime->minute);
            }
            $worktime->subHours($break->hour)->subMinutes($break->minute);
            $list[] = [
                'work_id' => $work->id,
                'name' => $work->user->name,
                'work_in' => Carbon::parse($work->work_in)->format('H:i'),
                'work_out' => Carbon::parse($work->work_out)->format('H:i'),
                'break_total' => $break->format('H:i'),
                'work_total' => $worktime->format('H:i'),
            ];

            return $list;
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
    public function work_list(Request $request){
        switch($request->input('date')){
            case 'back':
                $result = Carbon::parse($request->dateYm)->subMonth();
                break;
            case 'next':
                $result = Carbon::parse($request->dateYm)->addMonth();
                break;
            default:
                $result = Carbon::now();
                break;
        }

        $user = Auth::user();
        $dateYm = $result;
        $worklist = Work::where('user_id', Auth::id())->whereMonth('work_in', $result->format('m'))->with('break_times')->get();

        return view('admin.staffdetail', compact('user', 'dateYm', 'worklist'));
    }

// 共通処理
    //勤怠詳細（修正申請）
    public function detail_index($work_id){
        $this->setDetail($work_id);
    }
    public function admindetail_index($work_id){
        $this->setDetail($work_id);
    }
    public function detail_store($work_id, ChangeRequest $request){
        $this->detailStore($work_id, $request);
    }
    public function admindetail_store($work_id, ChangeRequest $request){
        $this->detailStore($work_id, $request);
    }

    // 申請一覧
    public function request_index(){
        $changes = Change_request::where([
            ['user_id', Auth::id()],
            ['approval_flg', 0],
        ])->get();
        // $changes = Change_request::where([
        //     ['user_id', Auth::id()],
        //     ['approval_flg', 1],
        // ])->get();

        return view('admin.request_list', compact('changes'));
    }


    private function setDetail($work_id){
        $change = Change_request::where([
            ['work_id', $work_id],
            ['approval_flg', 0],
        ])->with('user')->first();
        if(is_null($change)){
            $work = Work::find($work_id)->with('break_times', 'user')->first();
            $work_in = Carbon::parse($work->work_in);
            $count = 0;
            foreach($work->break_times as $break_time){
                $count++;
                if(is_null($break_time)){
                    if($count === 1){
                        $break_in1 = null;
                        $break_out1 = null;
                    }
                    $break_in2 = null;
                    $break_out2 = null;
                }
                if($count ===1){
                    $break_in1 = Carbon::parse($break_time->break_in)->format('H:i');
                    $break_out1 = Carbon::parse($break_time->break_out)->format('H:i');
                }else{
                    $break_in2 = Carbon::parse($break_time->break_in)->format('H:i');
                    $break_out2 = Carbon::parse($break_time->break_out)->format('H:i');
                }
            }
            $list = [
                'work_id' => $work->id,
                'name' => $work->user->name,
                'year' => $work_in->year(),
                'month' => $work_in->month(),
                'day' => $work_in->day(),
                'work_in' => $work_in->format('H:i'),
                'work_out' => Carbon::parse($work->work_out)->format('H:i'),
                'break_in1' => $break_in1,
                'break_out1' => $break_out1,
                'break_in2' => $break_in2,
                'break_out2' => $break_out2,
                'request_flg' => '0',
            ];
        }else{
            $work_in = Carbon::parse($change->change_work_in);
            $list = [
                'work_id' => $change->work_id,
                'name' => $change->user->name,
                'year' => $work_in->format('Y'),
                'month' =>$work_in->format('m'),
                'day' => $work_in->format('d'),
                'work_in' => $work_in->format('H:i'),
                'work_out' => Carbon::parse($change->change_work_out)->format('H:i'),
                'break_in1' => Carbon::parse($change->change_break_in1)->format('H:i'),
                'break_out1' => Carbon::parse($change->change_break_out1)->format('H:i'),
                'break_in2' => Carbon::parse($change->change_break_in2)->format('H:i'),
                'break_out2' => Carbon::parse($change->change_break_out2)->format('H:i'),
                'remarks' => $change->change_remarks,
                'request_flg' => 1,
            ];
        }

        return view('admin.admindetail', compact('list'));
    }
    private function detailStore($work_id, $request){
        $work = Work::find($work_id)->first();
        $changeStart = Carbon::parse($work->work_in)->setTimeFromTimeString($request->work_in);
        $changeEnd = Carbon::parse($work->work_out)->setTimeFromTimeString($request->work_out);
        Change_request::create(
            [
                'user_id' => Auth::id(),
                'work_id' => $work_id,
                'change_work_in' => $changeStart,
                'change_work_out' => $changeEnd,
                'change_break_in1' => $request->break_in1,
                'change_break_out1' => $request->break_out1,
                'change_break_in2' => $request->break_in2,
                'change_break_out2'=> $request->break_out2,
                'change_remarks' => $request->remarks,
            ]
        );

        return redirect('/attendance/list');
    }
}