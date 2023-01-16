<?php

use App\Constants\Types\MeetingUser\MeetingUserStatusHappenedType;
use App\Constants\Types\MeetingUser\MeetingUserStatusPredictedType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('meeting_id')
                    ->index()
                    ->comment('جلسه');

            $table->unsignedBigInteger('user_id')
                    ->index()
                    ->comment('کاربر');

            $table->unsignedTinyInteger('status_predicted')
                    ->index()
                    ->default(MeetingUserStatusPredictedType::MEETING_USER_STATUS_PREDICTED_DEFAULT)
                    ->comment('وضعیت {۱نامشخص  ۲شرکت میکنم  ۳شرکت نمیکنم  ۴شاید شرکت کنم}');

            $table->unsignedTinyInteger('status_happened')
                    ->index()
                    ->default(MeetingUserStatusHappenedType::MEETING_USER_STATUS_HAPPENED_DEFAULT)
                    ->comment('وضعیت {۱نامشخص  ۲شرکت کرده  ۳شرکت نکرده}');

            // $table->timestamps();

            $table
                ->foreign('meeting_id')
                ->references('id')
                ->on('meetings')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('meeting_user');
    }
}
