<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->string('color')->nullable();
            $table->integer('age')->nullable();
            $table->enum('size', ['grande', 'médio', 'pequeno'])->nullable();
        });
    }

    public function down()
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn('color');
            $table->dropColumn('age');
            $table->dropColumn('size');
        });
    }
};
