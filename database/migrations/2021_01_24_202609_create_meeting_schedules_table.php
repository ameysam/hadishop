<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('meeting_schedules', function (Blueprint $table) {
        //     $table->id();

        //     $table->unsignedBigInteger('center_id')
        //             ->index()
        //             ->nullable()
        //             ->comment('مرکز');

        //     $table->unsignedBigInteger('meeting_id')
        //             ->index()
        //             ->nullable()
        //             ->comment('جلسه');

        //     $table->unsignedBigInteger('room_id')
        //             ->index()
        //             ->nullable()
        //             ->comment('اتاق');

        //     $table->date('day')
        //             ->nullable()
        //             ->comment('روز');

        //     $table->time('started_time', $precision = 0)->nullable()->comment('ساعت شروع');

        //     $table->time('finished_time', $precision = 0)->nullable()->comment('ساعت پایان');

        //     $table->timestamps();

        //     $table
        //         ->foreign('center_id')
        //         ->references('id')
        //         ->on('centers')
        //         ->onUpdate('cascade')
        //         ->onDelete('set null');

        //     $table
        //         ->foreign('meeting_id')
        //         ->references('id')
        //         ->on('meetings')
        //         ->onUpdate('cascade')
        //         ->onDelete('set null');

        //     $table
        //         ->foreign('room_id')
        //         ->references('id')
        //         ->on('rooms')
        //         ->onUpdate('cascade')
        //         ->onDelete('set null');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('meeting_schedules');
    }
}
