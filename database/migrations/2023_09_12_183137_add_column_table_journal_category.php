<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'journal_categories';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        dropColumnIfExist($this->table, 'is_lock', function (Blueprint $table, $column) {
            $table->tinyInteger($column)->nullable()->after('is_active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
