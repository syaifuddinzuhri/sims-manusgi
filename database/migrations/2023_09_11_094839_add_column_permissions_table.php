<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'permissions';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        dropColumnIfExist($this->table, 'label', function (Blueprint $table, $column) {
            $table->string($column)->nullable()->after('name');
        });
        dropColumnIfExist($this->table, 'parent_id', function (Blueprint $table, $column) {
            $table->unsignedBigInteger($column)->nullable()->after('id');
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
