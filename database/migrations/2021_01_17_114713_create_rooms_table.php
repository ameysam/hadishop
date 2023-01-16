<?php

use App\Constants\DBConstant;
use App\Constants\Types\Room\RoomStatusType;
use App\Constants\Types\Room\RoomType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('center_id')
                    ->index()
                    ->nullable()
                    ->comment('مرکز');

            $table->unsignedBigInteger('schedule_id')
                    ->index()
                    ->nullable()
                    ->comment('زمان‌بندی');

            $table->unsignedTinyInteger('type')
                    ->index()
                    ->default(RoomType::ROOM_NORMAL)
                    ->comment('نوع {۱عادی ۲جلسات}');

            $table->string('name', DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH)
                    ->nullable()
                    ->comment('نام'); #63

            $table->unsignedSmallInteger('capacity')
                    ->default(1)
                    ->comment('ظرفیت');

            $table->unsignedTinyInteger('status')
                    ->index()
                    ->default(RoomStatusType::ROOM_STATUS_ACTIVE)
                    ->comment('وضعیت {۱فعال ۲غیرفعال}');

            $table->text('description')
                    ->nullable()
                    ->comment('توضیحات');

            $table->softDeletes();
            $table->timestamps();

            $table
                ->foreign('center_id')
                ->references('id')
                ->on('centers')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table
                ->foreign('schedule_id')
                ->references('id')
                ->on('schedules')
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
        Schema::dropIfExists('rooms');
    }
}
