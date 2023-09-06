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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_category_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('date')->nullable();
            $table->float('amount')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('payment_category_id')->references('id')->on('payment_categories')->onDelete('set null')->onUpdate('cascade');
            $table->index('payment_category_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};