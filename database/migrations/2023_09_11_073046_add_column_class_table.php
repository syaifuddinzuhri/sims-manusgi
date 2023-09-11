<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'classes';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        dropColumnIfExist($this->table, 'department_id', function (Blueprint $table, $column) {
            $table->unsignedBigInteger($column)->nullable()->after('name');

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null')->onUpdate('cascade');
            $table->index('department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
