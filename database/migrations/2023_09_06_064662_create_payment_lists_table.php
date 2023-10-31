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
        Schema::create('payment_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_category_id')->nullable();
            $table->enum('name', GlobalConstant::PAYMENT_LISTS)->nullable();
            $table->float('amount', 16, 0)->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('payment_category_id')->references('id')->on('payment_categories')->onDelete('set null')->onUpdate('cascade');
            $table->index('payment_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_lists');
    }
};