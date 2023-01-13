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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('title', 30);
            $table->string('resource_url', 255)->nullable();
            $table->string('describe', 255)->nullable();
            $table->dateTime('create_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
            $table->dateTime('update_at')->default(DB::raw('CURRENT_TIMESTAMP'))->useCurrentOnUpdate()->comment('更新時間');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
};
