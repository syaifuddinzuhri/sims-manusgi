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
        Schema::create('payment_category_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_category_id')->nullable();
            $table->enum('type', GlobalConstant::PAYMENT_CATEGORY_PAYMENTS)->nullable();
            $table->float('free_amount', 16, 0)->nullable()->default(0);
            $table->float('january_amount', 16, 0)->nullable()->default(0);
            $table->float('february_amount', 16, 0)->nullable()->default(0);
            $table->float('march_amount', 16, 0)->nullable()->default(0);
            $table->float('april_amount', 16, 0)->nullable()->default(0);
            $table->float('may_amount', 16, 0)->nullable()->default(0);
            $table->float('june_amount', 16, 0)->nullable()->default(0);
            $table->float('july_amount', 16, 0)->nullable()->default(0);
            $table->float('august_amount', 16, 0)->nullable()->default(0);
            $table->float('september_amount', 16, 0)->nullable()->default(0);
            $table->float('october_amount', 16, 0)->nullable()->default(0);
            $table->float('november_amount', 16, 0)->nullable()->default(0);
            $table->float('december_amount', 16, 0)->nullable()->default(0);
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
        Schema::dropIfExists('payment_category_payments');
    }
};
