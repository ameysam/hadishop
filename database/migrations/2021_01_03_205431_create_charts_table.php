<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('center_id')
                    ->index()
                    ->nullable()
                    ->comment('مرکز');

            $table->unsignedBigInteger('parent_id')
                    ->index()
                    ->nullable()
                    ->comment('والد');

            $table->unsignedBigInteger('post_id')
                    ->index()
                    ->nullable()
                    ->comment('سمت');

            $table->unsignedBigInteger('user_id')
                    ->index()
                    ->nullable()
                    ->comment('کاربر');

            $table->unsignedSmallInteger('level')
                    ->default(1)
                    ->comment('رتبه');

            $table->timestamps();

            $table
                ->foreign('center_id')
                ->references('id')
                ->on('centers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreign('parent_id')
                ->references('id')
                ->on('charts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreign('post_id')
                ->references('id')
                ->on('posts')
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
        Schema::dropIfExists('charts');
    }
}
