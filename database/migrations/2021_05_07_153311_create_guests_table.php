<?php

use App\Constants\DBConstant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();

            $table->string('first_name', DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH)
                ->nullable()
                ->comment('نام'); #63

            $table->string('last_name', DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH)
                ->nullable()
                ->comment('نام خانوادگی'); #63

            $table->unsignedBigInteger('guestable_id')->nullable();

            $table->string('guestable_type', DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
