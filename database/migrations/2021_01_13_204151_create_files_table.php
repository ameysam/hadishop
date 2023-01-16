<?php

use App\Constants\DBConstant;
use App\Constants\Types\File\FileReasonType;
use App\Constants\Types\File\FileVisibilityType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {

            $table->id();
            
            $table->unsignedBigInteger('uploader_id')->nullable()->comment('شخص آپلود کننده');

            $table->unsignedBigInteger('user_id')->nullable()->comment('صاحب فایل');

            $table->unsignedBigInteger('center_id')->nullable()->comment('مرکز');

            $table->unsignedBigInteger('fileable_id')->index()->comment('آیدی رکوردی که فایل برای اون آپلود شده');
            
            $table->string('fileable_type', DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH)->comment('مدل رکوردی که فایل برای اون آپلود شده'); #63
            
            $table->string('origin_name', DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH)->comment('نام اصلی فایل در سیستم کاربر');
            
            $table->string('uploaded_name', DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH)->comment('نامی که بعد از آپلود دریافت کرده');
            
            $table->string('type_name', DBConstant::MARIA_FIELD_STRING_SHORTEST_LENGTH)->comment('نوع فایل');

            $table->unsignedTinyInteger('type')->comment('دسته بندی نوع فایل');
            
            $table->string('extension', DBConstant::MARIA_FIELD_STRING_SHORTEST_LENGTH)->comment('پسوند فایل');

            $table->string('full_path', DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH)->comment('مسیر کامل');
            
            $table->string('path', DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH)->comment('مسیر نسبی');
            
            $table->unsignedSmallInteger('package_count')->default(1)->comment('تعداد فایل هایی که از رکورد مرجع ذخیره شده اند');

            $table->unsignedTinyInteger('visibility_type')->default(FileVisibilityType::FILE_VISIBILITY_PRIVATE)->comment('نوع  ۱عمومی  ۲مرکزی  ۳خصوصی');
            
            $table->unsignedTinyInteger('reason_type')->default(FileReasonType::FILE_REASON_DEFAULT)->comment('علت ذخیره فایل');

            $table->softDeletes();

            $table->timestamps();

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table
                ->foreign('uploader_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table
                ->foreign('center_id')
                ->references('id')
                ->on('centers')
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
        Schema::dropIfExists('files');
    }
}
