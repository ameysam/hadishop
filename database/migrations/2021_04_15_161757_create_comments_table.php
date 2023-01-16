<?php

use App\Constants\DBConstant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')
                    ->nullable()
                    ->comment('فرستنده');

            $table->unsignedBigInteger('center_id')
                    ->nullable()
                    ->comment('مرکز');

            $table->unsignedBigInteger('commentable_id');

            $table->string('commentable_type', DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH);

            $table->text('content')->nullable()->comment('متن');

            $table->softDeletes();
            $table->timestamps();

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('no action');

            $table
                ->foreign('center_id')
                ->references('id')
                ->on('centers')
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
        Schema::dropIfExists('comments');
    }
}
