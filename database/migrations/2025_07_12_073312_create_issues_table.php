<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('building');
            $table->string('room');
            $table->string('equipment');
            $table->text('description')->nullable();
            $table->string('email');
            $table->string('phone')->nullable(); // เพิ่มเบอร์โทร
            $table->string('image_path')->nullable(); // รูปภาพแนบ
            $table->string('status')->default('pending'); // pending หรือ replied
            $table->text('admin_reply')->nullable(); // คำตอบจากแอดมิน
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
