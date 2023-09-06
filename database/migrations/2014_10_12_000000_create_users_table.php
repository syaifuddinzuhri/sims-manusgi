<?php

use App\Constants\GlobalConstant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('nisn')->nullable();
            $table->string('nip')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->enum('gender', GlobalConstant::GENDER)->nullable();
            $table->string('pob')->nullable();
            $table->date('dob')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->float('balance')->nullable()->default(0);
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->tinyInteger('is_active')->nullable()->default(1);
            $table->tinyInteger('is_alumni')->nullable()->default(0);
            $table->integer('passed_year')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null')->onUpdate('cascade');
            $table->index('class_id');
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
};
