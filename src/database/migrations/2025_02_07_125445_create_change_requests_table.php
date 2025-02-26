<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('work_id');
            $table->datetime('change_work_in');
            $table->datetime('change_work_out');
            $table->time('change_break_in1')->nullable();
            $table->time('change_break_out1')->nullable();
            $table->time('change_break_in2')->nullable();
            $table->time('change_break_out2')->nullable();
            $table->string('change_remarks');
            $table->tinyInteger('approval_flg')->default(0)->comment('0:承認待ち,1:承認済み');
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('change_requests');
    }
}
