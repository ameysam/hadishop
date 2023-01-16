<?php

use App\Constants\DBConstant;
use App\Constants\Types\Center\CenterStatusType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers', function (Blueprint $table) {
            $table->id();

            $table->string('name', DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH)
                    ->nullable()->comment('نام'); #63

            $table->unsignedBigInteger('type_id')
                    ->index()
                    ->nullable()
                    ->comment('نوع');

            $table->unsignedTinyInteger('status')
                    ->index()
                    ->default(CenterStatusType::CENTER_STATUS_ACTIVE)
                    ->comment('وضعیت {۱فعال ۲غیرفعال}');

            $table->text('address')
                    ->nullable()
                    ->comment('آدرس');

            $table->text('contacts')
                    ->nullable()
                    ->comment('اطلاعات تماس');


            $table->string('admins_quick', DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH)
                    ->default('[]')
                    ->comment('مدیرها'); #255

            $table->decimal('lat', 20, 18)->nullable()->comment('موقعیت جغرافیایی');

            $table->decimal('lng', 20, 18)->nullable()->comment('موقعیت جغرافیایی');

            $table->softDeletes();
            $table->timestamps();

            $table
                ->foreign('type_id')
                ->references('id')
                ->on('center_types')
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
        Schema::dropIfExists('centers');
    }
}
