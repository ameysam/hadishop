<?php

use App\Constants\DBConstant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCenterTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_types', function (Blueprint $table) {
            $table->id();

            $table->string('name', DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH)
                    ->nullable()->comment('نام'); #255

            $table->unsignedBigInteger('user_id')
                    ->nullable()
                    ->comment('کاربر');

            $table->timestamps();

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('center_types');
    }
}
