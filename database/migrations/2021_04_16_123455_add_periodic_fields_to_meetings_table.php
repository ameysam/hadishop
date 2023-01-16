<?php

use App\Constants\Types\Meeting\MeetingPeriodicType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPeriodicFieldsToMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->unsignedBigInteger('periodic_reference_id')
                    ->nullable()
                    ->after('proceedings')
                    ->comment('آی‌دی جلسه اصلی');

            $table->unsignedSmallInteger('periodic_type')
                    ->default(MeetingPeriodicType::MEETING_PERIODIC_NON_PERIODIC)
                    ->after('periodic_reference_id')
                    ->comment('نوع تکرار دوره‌ای');

            $table->unsignedTinyInteger('periodic_count')
                    ->default(1)
                    ->after('periodic_type')
                    ->comment('چندمین تکرار');


            $table
                ->foreign('periodic_reference_id')
                ->references('id')
                ->on('meetings')
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
            $table->dropColumn('periodic_count');
            $table->dropColumn('periodic_type');
            $table->dropColumn('periodic_reference_id');
        });
    }
}
