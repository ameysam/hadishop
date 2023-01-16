<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_role', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('meeting_id')
                    ->index()
                    ->comment('جلسه');

            $table->unsignedBigInteger('role_id')
                    ->index()
                    ->comment('نقش');

            $table
                ->foreign('meeting_id')
                ->references('id')
                ->on('meetings')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreign('role_id')
                ->references('id')
                ->on('roles')
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
        Schema::dropIfExists('meeting_role');
    }
}
