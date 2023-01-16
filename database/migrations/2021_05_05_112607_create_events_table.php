<?php

use App\Constants\DBConstant;
use App\Constants\Types\Event\EventStatusType;
use App\Constants\Types\Event\EventPeriodicType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')
                    ->index()
                    ->nullable()
                    ->comment('کاربر ایجاد کننده');

            $table->unsignedBigInteger('center_id')
                    ->index()
                    ->nullable()
                    ->comment('مرکز');

            $table->unsignedBigInteger('room_id')
                    ->index()
                    ->nullable()
                    ->comment('اتاق');

            $table->string('name', DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH)
                    ->nullable()
                    ->comment('نام'); #255

            $table->text('description')
                    ->nullable()
                    ->comment('توضیحات');

            $table->unsignedTinyInteger('status')
                    ->index()
                    ->default(EventStatusType::EVENT_STATUS_ACTIVE)
                    ->comment('وضعیت {۱فعال ۲غیرفعال}');

            $table->unsignedBigInteger('periodic_reference_id')
                    ->nullable()
                    ->comment('آی‌دی رکورد اصلی');

            $table->unsignedSmallInteger('periodic_type')
                    ->default(EventPeriodicType::EVENT_PERIODIC_NON_PERIODIC)
                    ->comment('نوع تکرار دوره‌ای');

            $table->unsignedTinyInteger('periodic_count')
                    ->default(1)
                    ->comment('چندمین تکرار');

            $table->date('day')
                    ->nullable()
                    ->comment('روز');

            $table->time('started_time', $precision = 0)->nullable()->comment('ساعت شروع');

            $table->time('finished_time', $precision = 0)->nullable()->comment('ساعت پایان');

            $table->dateTime('started_at')->nullable()->comment('تاریخ شروع');

            $table->dateTime('finished_at')->nullable()->comment('تاریخ پایان');

            $table->string('color', DBConstant::MARIA_FIELD_STRING_SHORTEST_LENGTH)->nullable()->comment('رنگ پس زمینه');

            $table->softDeletes();
            $table->timestamps();

            $table
                ->foreign('center_id')
                ->references('id')
                ->on('centers')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table
                ->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table
                ->foreign('periodic_reference_id')
                ->references('id')
                ->on('events')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
