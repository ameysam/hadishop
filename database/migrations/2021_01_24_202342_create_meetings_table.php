<?php

use App\Constants\DBConstant;
use App\Constants\Types\Meeting\MeetingHoldingStatusType;
use App\Constants\Types\Meeting\MeetingStatusType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
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
                    ->default(MeetingStatusType::MEETING_STATUS_ACTIVE)
                    ->comment('وضعیت {۱فعال ۲غیرفعال}');

            $table->unsignedTinyInteger('holding_status')
                    ->index()
                    ->default(MeetingHoldingStatusType::MEETING_HOLDING_STATUS_WAITING_FOR_START)
                    ->comment('وضعیت برگزاری {۱در انتظار ۲در حال برگزاری ۳خاتمه یافته ۴برگزار نشده}');

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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
