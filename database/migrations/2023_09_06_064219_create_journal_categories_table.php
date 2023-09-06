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
        Schema::create('journal_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('type', GlobalConstant::JOURNAL_CATEGORIES)->nullable();
            $table->longText('notes')->nullable();
            $table->tinyInteger('is_active')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal_categories');
    }
};
