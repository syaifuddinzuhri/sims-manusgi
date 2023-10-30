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
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('name')->nullable();
            $table->float('amount', 16, 0)->nullable();
            $table->longText('notes')->nullable();
            $table->unsignedBigInteger('journal_category_id')->nullable();
            $table->unsignedBigInteger('payment_category_detail_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('payment_category_detail_id')->references('id')->on('payment_category_details')->onDelete('set null')->onUpdate('cascade');
            $table->index('payment_category_detail_id');
            $table->foreign('journal_category_id')->references('id')->on('journal_categories')->onDelete('set null')->onUpdate('cascade');
            $table->index('journal_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journals');
    }
};
