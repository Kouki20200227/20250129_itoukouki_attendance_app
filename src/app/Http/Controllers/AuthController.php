<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;

class AuthController extends Controller
{
    // 勤怠一覧
    public function admin_index(){
        return view('admin.adminindex');
    }
    // 勤怠詳細
    public function admin_detail(){
        return view('admin.admindetail');
    }
    // スタッフ一覧
    public function staff_list(){
        return view('admin.stafflist');
    }
    // スタッフ別勤怠一覧
    public function staff_detail(){
        return view('admin.staffdetail');
    }
    // 申請一覧
    public function request_list(){
        return view('admin.requestlist');
    }

    public function index(){
        return view('index');
    }
}