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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->unique();
            $table->string('name');
            $table->string('eng_name');
            $table->integer('nominal');
            $table->string('parent_code')->nullable();
            $table->integer('iso_num_code');
            $table->string('iso_char_code', 10)->unique();
            $table->timestamps();

            // Indexes
            $table->index('iso_char_code');
            $table->index('iso_num_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
};
