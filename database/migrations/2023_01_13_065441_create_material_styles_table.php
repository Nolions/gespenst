<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('material_styles', function (Blueprint $table) {
            $table->unsignedBigInteger('material_id');
            $table->enum('kolb_style', ['ce', 'ro', 'ac', 'ae']);
            $table->dateTime('create_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');

            $table->foreign('material_id')->references('id')->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_styles');
    }
};
