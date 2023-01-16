<?php

use App\Constants\DBConstant;
use App\Constants\Types\Schedule\ScheduleStatusType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('center_id')
                    ->index()
                    ->nullable()
                    ->comment('مرکز');

            $table->string('name', DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH)
                    ->nullable()
                    ->comment('نام'); #255

            $table->unsignedTinyInteger('status')
                    ->index()
                    ->default(ScheduleStatusType::SCHEDULE_STATUS_ACTIVE)
                    ->comment('وضعیت {۱فعال ۲غیرفعال}');

            $table->date('started_date')->nullable()->comment('تاریخ شروع');

            $table->date('finished_date')->nullable()->comment('تاریخ پایان');

            $table->time('started_time', $precision = 0)->nullable()->comment('ساعت شروع');

            $table->time('finished_time', $precision = 0)->nullable()->comment('ساعت پایان');

            $table->unsignedSmallInteger('reserve_duration')->nullable()->comment('مدت زمان هر رزرو به دقیقه');

            $table->unsignedSmallInteger('gap_duration')->nullable()->comment('فاصله بین هر رزرو به دقیقه');

            $table->softDeletes();
            $table->timestamps();

            $table
                ->foreign('center_id')
                ->references('id')
                ->on('centers')
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
        Schema::dropIfExists('schedules');
    }
}
