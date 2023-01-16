<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSecretaryFieldToMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->unsignedBigInteger('secretary_id')
                    ->nullable()
                    ->after('color')
                    ->comment('دبیر جلسه');

            $table->text('proceedings')
                    ->nullable()
                    ->after('secretary_id')
                    ->comment('صورتجلسه');


            $table
                ->foreign('secretary_id')
                ->references('id')
                ->on('users')
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
        Schema::table('meetings', function (Blueprint $table) {
            $table->dropColumn('proceedings');
            $table->dropColumn('secretary_id');
        });
    }
}
