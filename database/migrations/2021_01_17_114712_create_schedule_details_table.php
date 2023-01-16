<?php

use App\Constants\DBConstant;
use App\Constants\Types\Schedule\ScheduleStatusType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('center_id')
                    ->index()
                    ->nullable()
                    ->comment('مرکز');

            $table->unsignedBigInteger('schedule_id')
                    ->index()
                    ->nullable()
                    ->comment('زمان‌بندی');

            $table->dateTime('started_at')->nullable();

            $table->dateTime('finished_at')->nullable();

            $table->unsignedTinyInteger('status')
                    ->index()
                    ->default(ScheduleStatusType::SCHEDULE_STATUS_ACTIVE)
                    ->comment('وضعیت {۱فعال ۲غیرفعال}');

            $table->softDeletes();
            $table->timestamps();

            $table
                ->foreign('center_id')
                ->references('id')
                ->on('centers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreign('schedule_id')
                ->references('id')
                ->on('schedules')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_details');
    }
}
