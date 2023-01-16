<?php

use App\Constants\DBConstant;
use App\Constants\Types\Permission\PermissionType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_titles', function (Blueprint $table) {
            $table->id();

            $table->string('title', DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH);

            $table->unsignedTinyInteger('type')->default(PermissionType::PERMISSION_SYSTEM)->comment('۱:سیستمی  ۲:مختص مرکز');

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
        Schema::dropIfExists('permission_titles');
    }
}
