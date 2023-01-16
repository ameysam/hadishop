<?php

use App\Constants\Types\MessageUser\MessageUserStatusType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('message_id')
                    ->index()
                    ->comment('پيام');

            $table->unsignedBigInteger('user_id')
                    ->index()
                    ->comment('کاربر');

            $table->unsignedTinyInteger('status')->default(MessageUserStatusType::MESSAGE_USER_STATUS_UNSEEN)->comment('نوع پيام  1ديده شده   2ديده نشده');

            $table->dateTime('seen_at')->nullable();


            $table
                ->foreign('message_id')
                ->references('id')
                ->on('messages')
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
        Schema::dropIfExists('message_user');
    }
}
