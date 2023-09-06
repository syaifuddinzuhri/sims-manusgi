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
            $table->timestamp('date')->nullable();
            $table->string('name')->nullable();
            $table->float('amount')->nullable();
            $table->longText('notes')->nullable();
            $table->unsignedBigInteger('journal_category_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
