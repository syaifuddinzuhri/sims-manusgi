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
        Schema::create('payment_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->unsignedBigInteger('academic_year_id')->nullable();
            $table->enum('type', GlobalConstant::PAYMENT_CATEGORY_TYPE)->nullable();
            $table->enum('target_type', GlobalConstant::PAYMENT_CATEGORY_GROUPS)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('cascade')->onUpdate('cascade');
            $table->index('payment_type_id');
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onDelete('cascade')->onUpdate('cascade');
            $table->index('academic_year_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_categories');
    }
};
