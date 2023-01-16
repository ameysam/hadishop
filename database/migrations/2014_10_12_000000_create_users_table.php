<?php

use App\Constants\DBConstant;
use App\Constants\Types\User\UserActivationStatusType;
use App\Constants\Types\User\UserActivationType;
use App\Constants\Types\User\UserGenderType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('mobile_no', DBConstant::MARIA_FIELD_STRING_SHORTEST_LENGTH)
                ->nullable()
                ->unique()
                ->index()
                ->comment('شماره همراه')
                ; #31

            $table->string('first_name', DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH)
                ->nullable()
                ->comment('نام'); #63


            $table->string('last_name', DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH)
                ->nullable()
                ->comment('نام خانوادگی'); #63


            $table->string('id_no', DBConstant::MARIA_FIELD_STRING_SHORTEST_LENGTH)
                ->nullable()
                ->unique()
                ->index()
                ->comment('کدشناسایی(کدملی-شماره پرسنلی)'); #31

            $table->unsignedBigInteger('province_id')
                    ->nullable()
                    ->comment('استان');

            $table->unsignedBigInteger('city_id')
                    ->nullable()
                    ->comment('شهر');

            $table->string('image', DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH)
                ->default('avatar.png')
                ->comment('تصویر کاربر');  #255


            $table->unsignedTinyInteger('gender')
                ->default(UserGenderType::USER_GENDER_MALE)
                ->comment('جنسیت {۱آقا ۲خانم}');


            $table->unsignedTinyInteger('activation_status')
                ->default(UserActivationStatusType::USER_ACTIVATION_STATUS_UNACTIVE)
                ->comment('وضعیت {۱فعال ۲غیرفعال}');

            $table->unsignedTinyInteger('activation_type')
                ->default(UserActivationType::USER_ACTIVATION_MOBILE)
                ->comment('فعال سازی {۱موبایل  ۲ایمیل}');


            $table->date('birthdate')
                ->nullable()
                ->comment('تاریخ تولد');

            $table->string('email', DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH)
                    ->nullable()
                    ->comment('ایمیل'); #255

            $table->string('password');

            $table->string('activation_token')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('city_id')
                ->references('id')
                ->on('province_cities')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table
                ->foreign('province_id')
                ->references('id')
                ->on('provinces')
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
        Schema::dropIfExists('users');
    }
}
