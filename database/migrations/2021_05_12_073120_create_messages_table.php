<?php

use App\Constants\DBConstant;
use App\Constants\Types\Message\MessageStatusType;
use App\Constants\Types\Message\MessageType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sender_id')
                    ->nullable()
                    ->comment('کاربر فرستنده');

            $table->string('sender_name', DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH)->nullable()->comment('نام فرستنده');

            $table->unsignedTinyInteger('type')->default(MessageType::MESSAGE_NON_SYSTEMIC)->comment('نوع پيام  1سيستمي  2غيرسيستمي');

            $table->string('title', DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH)->nullable()->comment('عنوان');

            $table->text('content')->nullable()->comment('متن');

            $table->unsignedBigInteger('messageable_id')->nullable();

            $table->string('messageable_type', DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH)->nullable();

            $table->timestamps();


            $table
                ->foreign('sender_id')
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
        Schema::dropIfExists('messages');
    }
}
