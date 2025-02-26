<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'work_in' => 'required',
            'work_out' => 'required|after:work_in',
            // 'work_in' => 'required|date_format:H:i',
            // 'work_out' => 'required|date_format:H:i|after:work_in',
            'break_in1' => 'nullable',
            'break_out1' => 'nullable|after:break_in',
            'break_in2' => 'nullable',
            'break_out2' => 'nullable|after:break_in',
            'remarks' => 'required',
        ];
    }
    public function messages(){
        return [
            'work_in.required' => '開始時間が未入力です',
            'work_out.required' => '終了時間が未入力です',
            'work_out.after' => '終了時刻には開始時刻より後の時刻を入力してください',
            'break_out1.after' => '終了時刻には開始時刻より後の時刻を入力してください',
            'break_out2.after' => '終了時刻には開始時刻より後の時刻を入力してください',
            'remarks.required' => '備考を入力してください',
        ];
    }
}
