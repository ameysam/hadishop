<?php

use App\Constants\DBConstant;
use App\Constants\Types\ContactUs\ContactUsSubjectType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us_form', function (Blueprint $table) {
            $table->id();

            $table->string('name', DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH)->nullable();

            $table->unsignedTinyInteger('subject_type')
                ->default(ContactUsSubjectType::CONTACT_US_DEFAULT)
                ->comment('موضوع');

            $table->string('mobile_no', DBConstant::MARIA_FIELD_STRING_SHORTEST_LENGTH)
                ->nullable()
                ->comment('شماره همراه')
                ; #31

            $table->string('email', DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH)
                ->nullable()
                ->comment('ایمیل'); #255

            $table->text('description')
                ->nullable()
                ->comment('توضیحات');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_us_form');
    }
}
