<?php

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
        Schema::create('payment_category_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_category_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('payment_category_id')->references('id')->on('payment_categories')->onDelete('set null')->onUpdate('cascade');
            $table->index('payment_category_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->index('user_id');
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
        Schema::dropIfExists('payment_category_details');
    }
};
